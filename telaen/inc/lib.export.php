<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.com/

*************************************************************************/



function convert2vcf($data) {
//
//mapping telaen key to vcf key
//

    $ldap_key= array (
                "name" => "FN",
                "email" => "EMAIL;PREF;INTERNET",
                "street" => "ADR;WORK",
                "work" => "TITLE"
    );

    $ldapfile="BEGIN:VCARD\r\nVERSION:2.1\r\n";
    foreach ($data as $key => $value) {

        if ((($key!="city") AND ($key!="state"))) {
            $testo=($key=="street") ? (";;".$data["street"].";".$data["city"].";;;".$data["state"]) : ($value);
            if (preg_match("/[@,\r,\(,\),;,:]/",$value)) {
                $testo=urlencode($testo);
                $testo=preg_replace('|\+|'," ",$testo);
                $testo=preg_replace('|%|',"=",$testo);
                $testo=chunk_split($testo,76,"=\r\n");
                $testo=substr($testo,0,strlen($testo)-3);
                $ldapfile.=$ldap_key[$key].";ENCODING=QUOTED-PRINTABLE:$testo\r\n";
            } else {
                $ldapfile.=$ldap_key[$key].":$testo\r\n";
            }
        }
    }

    $ldapfile.="REV:".date("Ymd\This",time())."\r\n";

    $ldapfile.="END:VCARD";
    return $ldapfile;
}


function export2ou ($data) {
    $file=convert2vcf($data);
    $filename=(empty($data['name']))?"Address":$data['name'];
    header("Content-Type: application/outlook");
    header("Content-Disposition: attachment; filename=\"$filename.vcf\"");
    header("Content-Description: PHP Generated Data");
    print $file;
}







// Example of use

// A contact data
// $data=array(
//                "name" => "Mario Rossi",
//                 "email" => "my@email.com",
//                 "street" => "The address",
//                 "city" => "my city",
//                 "state" => "my state",
//                 "work" => "System Eng."
// );
//
//
//
// export2ou($data);
//






?>
