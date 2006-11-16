<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.org/

Telaen is based on Uebimiau (http://uebimiau.sourceforge.net)
 by Aldoir Ventura (aldoir@users.sourceforge.net)
*************************************************************************/

require("./inc/htmlfilter.php");

class Telaen_core {

	var $mail_connection	= 0;
	var $mail_server		= "localhost";
	var $mail_port			= 110;
	var $mail_error_msg		= "";
	var $mail_user			= "unknown";
	var $mail_pass			= "";
	var $mail_email			= "unknown@localhost";
	var $mail_protocol		= "pop3";
	var $mail_prefix		= "";

	var $sanitize		= true;
	var $use_html			= false;
	var $charset			= "iso-8859-1";
	var $timezone			= "+0000";
	var $debug			= false;
	var $user_folder		= "./";
	var $temp_folder		= "./";
	var $timeout			= 10;
	var $displayimages		= false;
	var $save_temp_attachs		= true;
	var $current_level		= Array();
	// internal
	var $_msgbody			= "";
	var $_content			= Array();
	var $_sid			= "";
	var $_tnef			= "";

	/*******************/


	/**
	Open a file and read it until a double line break
	is reached.
	Used to get the list of cached messages from cache
	*/

	function _get_headers_from_cache($strfile) {
		if(!file_exists($strfile)) return;
		$f = fopen($strfile,"rb");
		while(!feof($f)) {
			$result .= preg_replace("/\r?\n/","\r\n",fread($f,4096));
			$pos = strpos($result,"\r\n\r\n");
			if(!($pos === false)) {
				$result = substr($result,0,$pos);
				break;
			}
		}
		fclose($f);
		unset($f); unset($pos); unset($strfile);
		return $result;
	}


	/**
	Open a file and read it fixing possible mistakes 
	on the line breaks. A single variable is returned
	*/

	function _read_file($strfile) {
		if($strfile == "" || !file_exists($strfile)) return;
		$fp = fopen($strfile,"rb"); fseek($fp,0,SEEK_END);
		$size = ftell($fp); rewind($fp);
		$result =  preg_replace("/\r?\n/","\r\n",fread($fp,$size)); 
		fclose($fp);
		unset($fp); unset($size);
		return $result;
	}

	/**
	Save the specified $content to disk using the $filename path
	*/

	function _save_file($filename,$content) {
		$tmpfile = fopen($filename,"wb");
		fwrite($tmpfile,$content);
		fclose($tmpfile);
		unset($content,$tmpfile);
	}


	/**
	Recursivelly remove files and directories
	*/

	function _RmdirR($location) { 

		if (substr($location,-1) <> "/") $location = $location."/";
		$all=opendir($location);
		while ($file=readdir($all)) { 
			if (is_dir($location.$file) && $file <> ".." && $file <> ".") { 
				$this->_RmdirR($location.$file);
				unset($file); 
			} elseif (!is_dir($location.$file)) { 
				unlink($location.$file); 
				unset($file); 
			}
		}
		closedir($all); 
		unset($all);
		rmdir($location);
	}


	/**
	Encode header strings to be compliant with MIME format
	
	TODO: i18n: Implement base64 encoding according to charsets
	*/

	function mime_encode_headers($string) {
		if($string == "") return;
		if(!eregi("^([[:print:]]*)$",$string))
		$string = "=?".$this->charset."?Q?".str_replace("+","_",str_replace("%","=",urlencode($string)))."?=";
		return $string;
	}


	/**
	Add a body, to a container. 
	Some malformed messages have more than one body. 
	Used to display inline attachments (images) too.
	*/
	function add_body($strbody) {
		global $block_external_images;
		if($this->sanitize)
			$strbody	=	HTMLFilter($strbody, "images/trans.gif", $block_external_images);
		if($this->_msgbody == "")
			$this->_msgbody = $strbody;
		else
			$this->_msgbody .= "\r\n<br>\r\n<br>\r\n<hr>\r\n<br>\r\n$strbody";
	}


	/**
	This function, if running under PHP 4.3+ will convert any string between charsets.
	If running under PHP < 4.3, will convert the string to PHP's default charset (iso-8859-1)
	*/

	function convert_charset($string, $from, $to) {
		$string = htmlentities($string, ENT_COMPAT, $from);
		if(function_exists('html_entity_decode')) { //PHP 4.3+
			return html_entity_decode($string, ENT_COMPAT, $to);
		} else {
			$trans_tbl = get_html_translation_table (HTML_ENTITIES);
			$trans_tbl = array_flip ($trans_tbl);
			return strtr ($string, $trans_tbl);
		}
	}

	/**
	Decode headers strings. Inverse of mime_encode_headers()
	*/

	function decode_mime_string($subject) {
		$string = $subject;

		if(($pos = strpos($string,"=?")) === false) return $string;

		while(!($pos === false)) {

			$newresult .= substr($string,0,$pos);
			$string = substr($string,$pos+2,strlen($string));
			$intpos = strpos($string,"?");
			$charset = substr($string,0,$intpos);
			$enctype = strtolower(substr($string,$intpos+1,1));
			$string = substr($string,$intpos+3,strlen($string));
			$endpos = strpos($string,"?=");
			$mystring = substr($string,0,$endpos);
			$string = substr($string,$endpos+2,strlen($string));
			if($enctype == "q") $mystring = quoted_printable_decode(ereg_replace("_"," ",$mystring)); 
			else if ($enctype == "b") $mystring = base64_decode($mystring);

			if($charset != $this->charset) $mystring = $this->convert_charset($mystring, $charset, $this->charset);

			$newresult .= $mystring;
			$pos = strpos($string,"=?");
			unset($intpos); unset($endpos); unset($charset); unset($enctype); unset($mystring);
		}
		$result = $newresult.$string;
		unset($mystring); unset($newresult); unset($pos);
		
		if(ereg("koi8", $subject)) $result = convert_cyr_string($result, "k", "w");
		unset($subject);
		return $result;

	}


	/**
	Split headers into an array, where the key is the same found in the header.
	
	Subject: Hi 
	
		will be converted in
	
	$decodedheaders["subject"] = "Hi";
	
	Some headers are broken into multiples lines, prefixed with a TAB (\t)
	*/
	function decode_header($header) {
		$headers = explode("\r\n",$header);
		$decodedheaders = Array();
		for($i=0;$i<count($headers);$i++) {
			
			// If current header starts with a TAB or is not very standard, 
			// attach it at the prev header			
			if(ereg("^[\t]",$headers[$i]) || !ereg("^[A-Z0-9a-z_-]+:",trim($headers[$i])) ) {
				$decodedheaders[$lasthead] .= " ".trim($headers[$i]);
			}
			else { // otherwise extract the header
				$thisheader = trim($headers[$i]);
				if(!empty($thisheader)) {			 	
					$dbpoint = strpos($thisheader,":");
					$headname = strtolower(substr($thisheader,0,$dbpoint));
					$headvalue = trim(substr($thisheader,$dbpoint+1));
					if(array_key_exists($headname, $decodedheaders))
						$decodedheaders[$headname] .= "; $headvalue";
					else 
						$decodedheaders[$headname] = $headvalue;
					$lasthead = $headname;										
				}
				unset($thisheader);
			}

		}
		unset($headers);
		return $decodedheaders;
	}


	/**
	Try to extract all names in a specified field (from, to, cc)
	In order to guess what is the format (the RFC support 3), it will
	try different ways to get an array with name and email
	*/

	function get_names($strmail) {
		$ARfrom = Array();
		$strmail = stripslashes(ereg_replace("(\t|\r|\n)","",$strmail));

		if(trim($strmail) == "") return $ARfrom;

		$armail = Array();
		$counter = 0;  $inthechar = 0;
		$chartosplit = ",;"; $protectchar = "\""; $temp = "";
		$lt = "<"; $gt = ">";
		$closed = 1;

		for($i=0;$i<strlen($strmail);$i++) {
			$thischar = $strmail[$i];
			if($thischar == $lt && $closed) $closed = 0;
			if($thischar == $gt && !$closed) $closed = 1;
			if($thischar == $protectchar) $inthechar = ($inthechar)?0:1;
			if(!(strpos($chartosplit,$thischar) === false) && !$inthechar && $closed) {
				$armail[] = $temp; $temp = "";
			} else 
				$temp .= $thischar;
		}

		if(trim($temp) != "") {
			$armail[] = trim($temp);
			unset($temp);
		}

		for($i=0;$i<count($armail);$i++) {
			$thisPart = trim(eregi_replace("^\"(.*)\"$", "\\1", trim($armail[$i])));
			if($thisPart != "") {
				if (eregi("(.*)<(.*)>", $thisPart, $regs)) {
					$email = trim($regs[2]);
					$name = trim($regs[1]);
				} else {
					if (eregi("([-a-z0-9_$+.]+@[-a-z0-9_.]+[-a-z0-9_]+)((.*))", $thisPart, $regs)) {
						$email = $regs[1];
						$name = $regs[2];
					} else
						$email = $thisPart;
				}

				$email = preg_replace("/<(.*)\\>/", "\\1", $email);
				$name = preg_replace("/\"(.*)\"/", "\\1", trim($name));
				$name = preg_replace("/\((.*)\)/", "\\1", $name);

				if ($name == "") $name = $email;
				if ($email == "") $email = $name;
				$ARfrom[$i]["name"] = $this->decode_mime_string($name);
				$ARfrom[$i]["mail"] = $email;
				unset($name);unset($email);
			}
		}
		unset($armail); 
		unset ($thisPart);
		return $ARfrom;
	}

	/**
	Try to extract the first name in a specified field (from, to, cc)
	In order to guess what is the format (the RFC support 3), it will
	try different ways to get the name and email
	*/

	function get_first_of_names($strmail) {
		$ARfrom = Array();
		$strmail = stripslashes(ereg_replace("(\t|\r|\n)","",$strmail));

		if(trim($strmail) == "") return $ARfrom;

		$counter = 0;  $inthechar = 0;
		$chartosplit = ",;"; $protectchar = "\""; $temp = "";
		$lt = "<"; $gt = ">";
		$closed = 1;

		if (eregi("[$chartosplit]", $strmail)) {
			for($i=0;$i<strlen($strmail);$i++) {
				$thischar = $strmail[$i];
				if($thischar == $lt && $closed) $closed = 0;
				if($thischar == $gt && !$closed) $closed = 1;
				if($thischar == $protectchar) $inthechar = ($inthechar)?0:1;
				if(!(strpos($chartosplit,$thischar) === false) && !$inthechar && $closed) {
					$armail = $temp; $temp = "";
					$i = strlen($strmail);
				} else 
					$temp .= $thischar;
			}
		} else {
			$armail = $strmail;
		}

		$thisPart = trim(eregi_replace("^\"(.*)\"$", "\\1", trim($armail)));
		if($thisPart != "") {
			if (eregi("(.*)<(.*)>", $thisPart, $regs)) {
				$email = trim($regs[2]);
				$name = trim($regs[1]);
			} else {
				if (eregi("([-a-z0-9_$+.]+@[-a-z0-9_.]+[-a-z0-9_]+)((.*))", $thisPart, $regs)) {
					$email = $regs[1];
					$name = $regs[2];
				} else
					$email = $thisPart;
			}

			$email = preg_replace("/<(.*)\\>/", "\\1", $email);
			$name = preg_replace("/\"(.*)\"/", "\\1", trim($name));
			$name = preg_replace("/\((.*)\)/", "\\1", $name);

			if ($name == "") $name = $email;
			if ($email == "") $email = $name;
			$ARfrom[0]["name"] = $this->decode_mime_string($name);
			$ARfrom[0]["mail"] = $email;

			unset($name);unset($email);
		}
		unset($armail); 
		unset ($thisPart);
		return $ARfrom;
	}

	/**
	Compile a body for multipart/alternative format.
	Guess the format we want and add it to the bod container
	*/

	function build_alternative_body($ctype,$body) {

		$boundary = $this->get_boundary($ctype);
		$parts = $this->split_parts($boundary,$body);

		$thispart = ($this->use_html)?$parts[1]:$parts[0];

		foreach($parts as $index => $value) {
			$email = $this->fetch_structure($value);

			$parts[$index] = $email;
			$parts[$index]["headers"] = $headers = $this->decode_header($email["header"]);
			unset($email);
			$ctype = split(";",$headers["content-type"]); $ctype = strtolower($ctype[0]);

			$parts[$index]["type"] = $ctype;
			if($this->use_html && $ctype == "text/html") {
				$part = $parts[$index];
				break;
			} elseif (!$this->use_html && $ctype == "text/plain") {
				$part = $parts[$index];
				break;
			}

		}

		if(!isset($part)) $part = $parts[0];
		unset($parts);


		$body = $this->compile_body($part["body"],$part["headers"]["content-transfer-encoding"],$part["headers"]["content-type"]);

		if(!$this->use_html && $part["type"] != "text/plain") $body = $this->html2text($body);
		if(!$this->use_html) $body = $this->build_text_body($body);
		$this->add_body($body);
	}

	/**
	Recursively compile the parts of multipart/* emails.
	'complex' means multipart/signed|mixed|related|report and other 
	types that can be added in the future
	*/

	function build_complex_body($ctype,$body) {
		global $sid,$lid,$ix,$folder;

		$Rtype = trim(substr($ctype,strpos($ctype,"type=")+5,strlen($ctype)));

		if(strpos($Rtype,";") != 0)
			$Rtype = substr($Rtype,0,strpos($Rtype,";"));
		if(substr($Rtype,0,1) == "\"" && substr($Rtype,-1) == "\"")
			$Rtype = substr($Rtype,1,strlen($Rtype)-2);


		$boundary = $this->get_boundary($ctype);
		$part = $this->split_parts($boundary,$body);

		for($i=0;$i<count($part);$i++) {

			$email = $this->fetch_structure($part[$i]);

			$header = $email["header"];
			$body = $email["body"];
			$headers = $this->decode_header($header);

			$ctype = $headers["content-type"];

			/*
			 * Special case for mac with resource and data fork
			 * Ignore apple data parts.
			 */
			if (eregi("application/applefile",$ctype)) {
				continue;
			}

			$cid = $headers["content-id"];

			$Actype = split(";",$headers["content-type"]);
			$types = split("/",$Actype[0]); $rctype = strtolower($Actype[0]);

			$is_download = (ereg("name=",$headers["content-disposition"].$headers["content-type"]) || $headers["content-id"] != "" || $rctype == "message/rfc822");

			if($rctype == "multipart/alternative") {

				$this->build_alternative_body($ctype,$body);

			} elseif($rctype == "multipart/appledouble") {

				/*
				 * Special case for mac with resource and data fork
				 */
				$this->build_complex_body($ctype,$body);

			} elseif($rctype == "text/plain" && !$is_download) {

				$body = $this->compile_body($body,$headers["content-transfer-encoding"],$headers["content-type"]);
				$this->add_body($this->build_text_body($body));

			} elseif($rctype == "text/html" &&  !$is_download) {

				$body = $this->compile_body($body,$headers["content-transfer-encoding"],$headers["content-type"]);

				if(!$this->use_html) $body = $this->build_text_body($this->html2text($body));
				$this->add_body($body);

			} elseif($rctype == "application/ms-tnef") {

				$body = $this->compile_body($body,$headers["content-transfer-encoding"],$headers["content-type"]);
				$this->extract_tnef($body,$boundary,$i);

			} elseif($is_download) {

				$thisattach 	= $this->build_attach($header,$body,$boundary,$i);
				$tree			= array_merge((array)$this->current_level, array($thisattach["index"]));
				$thisfile 		= "download.php?folder=".urlencode($folder)."&ix=".$ix."&attach=".join(",",$tree);
				$filename 		= $thisattach["filename"];
				$cid = preg_replace("/<(.*)\\>/", "\\1", $cid);

				if($cid != "") {
					$cid = "cid:$cid";
					$this->_msgbody	= preg_replace("/".quotemeta($cid)."/i",$thisfile,$this->_msgbody);

				} elseif($this->displayimages) {
					$ext = substr($thisattach["name"],-4);
					$allowed_ext = Array(".gif",".jpg",".GIF",".JPG",".Gif",".Jpg");
					if(in_array($ext,$allowed_ext)) {
						$this->add_body("<img src=\"$thisfile\">");
					}
				}

			} else
				$this->process_message($header,$body);

		}
	}


	/**
	Format a plain text string into a HTML formated string
	*/

	function build_text_body($body) {
		$body = preg_replace("/(\r\n|\n|\r|\n\r)/","<br>\\1",$this->make_link_clickable(htmlspecialchars($body)));
		return "<font face=\"Courier New\" size=\"2\">$body</font>";
	}

	/**
	Decode Quoted-Printable strings
	*/
	function decode_qp($str) {
		return quoted_printable_decode(preg_replace("/=\r?\n/", "", $str));
	}


	/**
	Convert URL and Emails into clickable links
	*/

	function make_link_clickable($str){

		$str = eregi_replace("([[:space:]])((f|ht)tps?:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "\\1<a class=autolink href=\"\\2\" target=\"_blank\">\\2</a>", $str); //http 
		$str = eregi_replace("([[:space:]])(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "\\1<a class=autolink href=\"http://\\2\" target=\"_blank\">\\2</a>", $str); // www. 
		$str = eregi_replace("([[:space:]])([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})","\\1<a class=autolink href=\"mailto:\\2\">\\2</a>", $str); // mail 

		$str = eregi_replace("^((f|ht)tp:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "<a href=\"\\1\" target=\"_blank\">\\1</a>", $str); //http 
		$str = eregi_replace("^(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "<a class=autolink href=\"http://\\1\" target=\"_blank\">\\1</a>", $str); // www. 
		$str = eregi_replace("^([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})","<a class=autolink href=\"mailto:\\1\">\\1</a>", $str); // mail 

		return $str;
	}


	/**
	Guess the type of the part and call the apropriated 
	method
	*/

	function process_message($header,$body) {
		$mail_info = $this->get_mail_info($header);
		$ctype = $mail_info["content-type"];
		$ctenc = $mail_info["content-transfer-encoding"];

		if($ctype == "") $ctype = "text/plain";

		$type = $ctype;

		$ctype = split(";",$ctype);
		$types = split("/",$ctype[0]);

		$maintype = trim(strtolower($types[0]));
		$subtype = trim(strtolower($types[1]));

		switch($maintype) {
		case "text":
			$body = $this->compile_body($body,$ctenc,$mail_info["content-type"]);
			switch($subtype) {
			case "html":
				if(!$this->use_html) $body = $this->build_text_body($this->html2text($body));
				$msgbody = $body;
				break;
			default:
				$this->extract_uuencoded($body);
				$msgbody = $this->build_text_body($body);
				break;
			}
			$this->add_body($msgbody);
			break;
		case "multipart":
			if(ereg($subtype,"signed,mixed,related,report"))
				$subtype = "complex";

			switch($subtype) {
			case "alternative":
				$msgbody = $this->build_alternative_body($ctype[1],$body);
				break;
			case "complex":
				$msgbody = $this->build_complex_body($type,$body);
				break;
			default:
				$thisattach = $this->build_attach($header,$body,"",0);
			}
			break;
		default:
			$thisattach = $this->build_attach($header,$body,"",0);
		}
	}

	/**
	Compile the attachment, saving it to cache and 
	add it to the $attachments array if needed
	*/

	function build_attach($header,$body,$boundary,$part) {

		global $mail,$temporary_directory,$userfolder;

		$headers = $this->decode_header($header);
		$cdisp = $headers["content-disposition"];
		$ctype = $headers["content-type"]; 

		preg_match("/filename ?= ?\"(.+)\"/i",$cdisp,$matches);
//		$filename = preg_replace("/\"(.*)\"/","\\1",trim($matches[1]));
		$filename = trim($matches[1]);
	
		if(!$filename) {
			preg_match("/name ?= ?\"(.+)\"/i",$ctype,$matches);
//			$filename = preg_replace("/\"(.*)\"/","\\1",trim($matches[1]));
			$filename = trim($matches[1]);
		}

		$tenc = $headers["content-transfer-encoding"];

		preg_match("/[a-z0-9]+/i",$cdisp,$matches);
		$content_disposition 	= $matches[0];

		preg_match("/[a-z0-9\/-]+/i",$ctype,$matches);
		$content_type 	= $matches[0];

		$tmp 			= explode("/",$content_type);
		$main_type 		= $tmp[0];
		$sub_type		= $tmp[1];

		$is_embebed = ($headers["content-id"] != "")?1:0;

		$body = $this->compile_body($body,$tenc,$ctype);


		if($filename == "" && $main_type == "message") {
			$attachheader = $this->fetch_structure($body);
			$attachheader = $this->decode_header($attachheader["header"]);
			$filename = $attachheader["subject"].".eml";
			unset($attachheader);
		} elseif($filename == "") {
			$filename = uniqid("").".tmp";
		}

		$filename = preg_replace("/[.]{2,}/",".",preg_replace("'(/|\\\\)+'","_",trim($this->decode_mime_string($filename))));
		$safefilename = preg_replace("/[ \t\.\W]+/", "_", $filename);
		$nIndex 							= count($this->_content["attachments"]);
		$temp_array["name"] 				= trim($filename);
		$temp_array["size"] 				= strlen($body);
		$temp_array["temp"] 				= $is_embebed;
		$temp_array["content-type"] 		= strtolower(trim($content_type));
		$temp_array["content-disposition"] 	= strtolower(trim($content_disposition));
		$temp_array["boundary"] 			= $boundary;
		$temp_array["part"] 				= $part;
		$temp_array["filename"] 			= $this->user_folder."_attachments/".md5($temp_array["boundary"])."_".$safefilename;
		$temp_array["type"] 				= "mime";
		$temp_array["index"]				= $nIndex;

		$this->_save_file($temp_array["filename"],$body);
		unset($body);
		$this->_content["attachments"][$nIndex] = $temp_array;

		return $temp_array;

	}


	/**
	Compile a string following the encoded method
	*/

	function compile_body($body,$enctype,$ctype) {

		$enctype = explode(" ",$enctype); $enctype = $enctype[0];
		if(strtolower($enctype) == "base64")
			$body = base64_decode($body);
		elseif(strtolower($enctype) == "quoted-printable")
			$body = $this->decode_qp($body);

		if(ereg("koi8", $ctype))
			$body = convert_cyr_string($body, "k", "w");
		else
			if(preg_match("/charset ?= ?\"?([a-z0-9-]+)\"?/i",$ctype,$regs)) {
				if($regs[1] != $this->charset) {
					$body = $this->convert_charset($body,$regs[1],$this->charset);
				}
			}

		return $body;

	}

	/**
	TODO: Remove this function

	function download_attach($header,&$body,$bound="",$part=0,$down=1,$type,$tnef) {
		if ($type == "uue") {
			$this->get_uuencoded($body,$bound,$down,"down");
		}else {
			if ($bound != "") {
				$parts = $this->split_parts($bound,$body);
				// split the especified part of mail, body and headers
				$email = $this->fetch_structure($parts[$part]);
				$header = $email["header"];
				$body = $email["body"];
				unset($email);
			}
			if($type == "tnef" && is_numeric($tnef)) 
				$this->get_tnef($header,$body,$tnef,$down,"down");
			else
				$this->build_attach($header,$body,"",0,$mode="down",$down);
		}
	}

	*/

	/**
	Guess the attachment format and call the specific method
	*/

	function save_attach($header,&$body,$filename,$type="mime",$tnef="-1",$bound) {
		switch($type) {
		case "uue": 
			$this->get_uuencoded($body,$bound,0,"save",$filename);
			break;
		case "tnef":
			$this->get_tnef($header,$body,$tnef,0,$mode="save",$filename);
			break;
		default:
			$this->build_attach($header,$body,"",0,$mode="save",0,$filename);
		}
	}

	
	/**
	Guess all needed information about this mail
	*/
	
	function get_mail_info($header, $first="ALL") {

		$myarray = Array();
		$headers = $this->decode_header($header);

		$myarray["message-id"] = (array_key_exists("message-id",$headers))?ereg_replace("<(.*)>","\\1",trim($headers["message-id"])):null;
		$myarray["content-type"] = (array_key_exists("content-type",$headers))?$headers["content-type"]:null;
		$myarray["priority"] = (array_key_exists("x-priority",$headers))?$headers["x-priority"][0]:null;
		$myarray["flags"] 		 = $headers["x-um-flags"]; // 
		$myarray["content-transfer-encoding"] = (array_key_exists("content-transfer-encoding",$headers))?str_replace("GM","-",$headers["content-transfer-encoding"]):null;

		$received	= ereg_replace("  "," ",$headers["received"]);
		$user_date	= ereg_replace("  "," ",$headers["date"]);

		if(eregi("([0-9]{1,2}[ ]+[A-Z]{3}[ ]+[0-9]{4}[ ]+[0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2})[ ]?((\+|-)[0-9]{4})?",$received,$regs)) {
			//eg. Tue, 4 Sep 2001 16:22:31 -0000
			$mydate = $regs[1];
			$mytimezone = $regs[2];
			if(empty($mytimezone))
				if(eregi("((\\+|-)[0-9]{4})",$user_date,$regs)) $mytimezone = $regs[1];
				else $mytimezone = $this->timezone;
		} elseif(eregi("(([A-Z]{3})[ ]+([0-9]{1,2})[ ]+([0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2})[ ]+([0-9]{4}))",$received,$regs)) {
			//eg. Tue Sep 4 16:26:17 2001 (Cubic Circle's style)
			$mydate = $regs[3]." ".$regs[2]." ".$regs[5]." ".$regs[4];
			if(eregi("((\\+|-)[0-9]{4})",$user_date,$regs)) $mytimezone = $regs[1];
			else $mytimezone = $this->timezone;
		} elseif(eregi("([0-9]{1,2}[ ]+[A-Z]{3}[ ]+[0-9]{4}[ ]+[0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2})[ ]?((\+|-)[0-9]{4})?",$user_date,$regs)) {
			//eg. Tue, 4 Sep 2001 16:22:31 -0000 (from Date header)
			$mydate = $regs[1];
			$mytimezone = $regs[2];
			if(empty($mytimezone))
				if(eregi("((\\+|-)[0-9]{4})",$user_date,$regs)) $mytimezone = $regs[1];
				else $mytimezone = $this->timezone;
		} else {
			$mydate		= date("d M Y H:i");
			$mytimezone	= $this->timezone;
		}

		$myarray["date"] = $this->build_mime_date($mydate,$mytimezone);
		$myarray["subject"] = $this->decode_mime_string($headers["subject"]);
		if ($first == "FIRST_ONLY") {
			$myarray["from"] = $this->get_first_of_names($headers["from"]);
			$myarray["to"] = $this->get_first_of_names($headers["to"]);
			$myarray["cc"] = $this->get_first_of_names($headers["cc"]);
			$myarray["reply-to"] = $this->get_first_of_names($headers["reply-to"]);
		} else {
			$myarray["from"] = $this->get_names($headers["from"]);
			$myarray["to"] = $this->get_names($headers["to"]);
			$myarray["cc"] = $this->get_names($headers["cc"]);
			$myarray["reply-to"] = $this->get_names($headers["reply-to"]);
		}
		$myarray["status"] = $headers["status"];
		$myarray["read"] = $headers["x-um-status"];
		$myarray["x-spam-level"] = $headers["x-spam-level"];
		unset($headers);
		return $myarray;

	}


	/**
	Convert a TIMESTAMP value into a RFC-compliant date
	Vola's note: I think it does exactly the opposite...
	*/

	function build_mime_date($mydate,$timezone = "+0000") {

		global $server_timezone_offset;

		// check if $timezone is valid
		if(!ereg("((\\+|-)[0-9]{4})",$timezone)) 
			$timezone = "+0000";
		// check if $mydate is valid, if no return current server time
		if(!$intdate = @strtotime($mydate)) 
			return time();
		if(preg_match("/(\\+|-)+([0-9]{2})([0-9]{2})/",$timezone,$regs)) 
			$datetimezone = ($regs[1].$regs[2]*3600)+($regs[1].$regs[3]*60);
		else 
			$datetimezone = 0;
		if(preg_match("/(\\+|-)+([0-9]{2})([0-9]{2})/",$this->timezone,$regs)) 
			$usertimezone = ($regs[1].$regs[2]*3600)+($regs[1].$regs[3]*60);
		else 
			$usertimezone = 0;
		if(preg_match("/(\\+|-)+([0-9]{2})([0-9]{2})/",$server_timezone_offset,$regs)) 
			$servertimezone = ($regs[1].$regs[2]*3600)+($regs[1].$regs[3]*60);
		else 
			$servertimezone = 0;

		/** Umm... the out time must be:
		    mailTime - mailTimeOffset = UTCmailtime (es: 10.00 AM +0200 = 8.00 AM UTC or 10.00 AM -0400 = 2.00 PM... 10-(-4) = 14)
		    UTCmailtime + useroffset = UserMailTime (es: user zone +0200, mailUTC 8.00 AM = 10.00 AM or with -0400 = 6.00 AM) 
		*/

		// debug echos
/**		echo "Server offset time config:" .$server_timezone_offset ."<br>";
		echo "Date time offset:" . $timezone ."<br>";
		echo "Date on function:" . $mydate ."<br>";
		echo "Converted date + date offset + user offset  + server offset:".$intdate." ". $datetimezone ." ". $usertimezone ." ". $servertimezone ."<br>";
		echo "Returned time:" . ($intdate - $datetimezone + $usertimezone + $servertimezone) ."<br>"; */

		return ($intdate - $datetimezone + $usertimezone + $servertimezone);
	}


	/**
	Main method called by script, start the decoding process
	*/
	function Decode($email) {
		$email = $this->fetch_structure($email);
		$this->_msgbody = "";
		$body = $email["body"];
		$header = $email["header"];
		$mail_info = $this->get_mail_info($header);
		$this->process_message($header,$body);
		$this->_content["headers"] = $header;
		$this->_content["date"] = $mail_info["date"];
		$this->_content["subject"] = $mail_info["subject"];
		$this->_content["message-id"] = $mail_info["message-id"];
		$this->_content["from"] = $mail_info["from"];
		$this->_content["to"] = $mail_info["to"];
		$this->_content["cc"] = $mail_info["cc"];
		$this->_content["reply-to"] = $mail_info["reply-to"];
		$this->_content["body"] = $this->_msgbody;
		$this->_content["read"] = $mail_info["read"];
		$this->_content["priority"] = $mail_info["priority"];
		$this->_content["flags"] = $mail_info["flags"];
		$this->_content["x-spam-level"] = $mail_info["x-spam-level"];
		return $this->_content;
	}

	/**
	Split an email by its boundary
	*/

	function split_parts($boundary,$body) {
		$startpos = strpos($body,$boundary)+strlen($boundary)+2;
		$lenbody = strpos($body,"\r\n$boundary--") - $startpos;
		$body = substr($body,$startpos,$lenbody);
		return explode($boundary."\r\n",$body);
	}

	/**
	Split header and body into an array
	*/

	function fetch_structure($email) {
		$ARemail = Array();
		$separador = "\r\n\r\n";
		$header = trim(substr($email,0,strpos($email,$separador)));
		$bodypos = strlen($header)+strlen($separador);
		$body = substr($email,$bodypos,strlen($email)-$bodypos);
		$ARemail["header"] = $header; $ARemail["body"] = $body;
		unset($header); unset($body);
		return $ARemail;
	}

	/**
	Guess the boundary from header
	*/

	function get_boundary($ctype){
		if(preg_match('/boundary[ ]?=[ ]?(["]?.*)/i',$ctype,$regs)) {
			$boundary = preg_replace('/^\"(.*)\"$/', "\\1", $regs[1]);
			return trim("--$boundary");
		}
	}

	/**
	Oposite of htmlentities.
	*/

	function unhtmlentities ($string) {
		$trans_tbl = get_html_translation_table (HTML_ENTITIES);
		$trans_tbl = array_flip ($trans_tbl);
		return strtr ($string, $trans_tbl);
	}

	/**
	Format a HTML message to be displayed as text if allow_html is off
	*/
	function html2text($str) {
		return $this->unhtmlentities(preg_replace(
				Array(	"'<(SCRIPT|STYLE)[^>]*?>.*?</(SCRIPT|STYLE)[^>]*?>'si",
						"'(\r|\n)'",
						"'<BR[^>]*?>'i",
						"'<P[^>]*?>'i",
						"'<\/?\w+[^>]*>'e"
						),
				Array(	"",
						"",
						"\r\n",
						"\r\n\r\n",
						""),
				$str));
	}
	
	/**
	Decode UUEncoded attachments
	*/
	function UUDecode($data) {
		$b64chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/A';
		$uudchars='`!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_ ';
		$lines = preg_split('/\r?\n/',$data);
		$encode = "";
		foreach ($lines as $line) {
			if($line != '') {
				$count   = (ord($line[0])-32)%64;
				$count   = ceil(($count*4)/3);
				$encode .= substr(ltrim($line), 1, $count);
			}
		}
		$encode = strtr($encode, $uudchars, $b64chars);
		while(strlen($encode) % 4) {
			$encode .= '=';
		}
		return base64_decode($encode);
	}

	/**
	Guess all UUEncoded in the body
	*/

	function extract_uuencoded(&$body) {
		$regex = "/(begin ([0-7]{3}) (.+))\r?\n(.+)\r?\nend/Us";
		preg_match_all($regex, $body, $matches);
		for ($i = 0; $i < count($matches[3]); $i++) {

			$boundary	= $matches[1][$i];
			$fileperm	= $matches[2][$i];
			$filename	= $matches[3][$i];
			$stream		= $this->UUDecode($matches[4][$i]);

			$temp_array["index"]				= count($this->_content["attachments"]);
			$temp_array["name"] = $filename;
			$temp_array["size"] = strlen($stream);
			$temp_array["content-type"] = "application/unknown";
			$temp_array["content-disposition"] = "attachment";
			$temp_array["boundary"] = $boundary;
			$temp_array["part"] = 0;
			$temp_array["type"] = "uue";
			$temp_array["filename"] = $this->user_folder."_attachments/".md5($temp_array["boundary"])."_".$temp_array["name"];
			$this->_content["attachments"][] = $temp_array;
			$this->_save_file($temp_array["filename"],$stream);
			unset($temp_array);
		}
		$body = preg_replace($regex, "", $body);
	}


	/**
	Extract all attachmentes contained in a MS-TNEF attachment
	*/

	function extract_tnef(&$body,$boundary,$part) {
		$tnefobj = $this->_tnef->Decode($body);

		for($i=0;$i<count($tnefobj);$i++) {
			$content							= $tnefobj[$i]["stream"];
			$temp_array["index"]				= count($this->_content["attachments"]);
			$temp_array["name"] 				= $tnefobj[$i]["name"];
			$temp_array["size"] 				= $tnefobj[$i]["size"];
			$temp_array["content-type"] 		= $tnefobj[$i]["type0"]."/".$tnefobj[$i]["type1"];
			$temp_array["content-disposition"] 	= "attachment";
			$temp_array["boundary"] 			= $boundary;
			$temp_array["part"] 				= $part;
			$temp_array["type"] 				= "tnef";
			$temp_array["tnef"] 				= $i;
			$temp_array["filename"] 			= $this->user_folder."_attachments/".md5($temp_array["boundary"])."_".$temp_array["name"];
			
			$this->_content["attachments"][] 	= $temp_array;

			$this->_save_file($temp_array["filename"],$content);
			unset($temp_array);
		}

	}

	/**
	Used for IMAP servers wich uses INBOX. as prefix for folder names
	*/

	function fix_prefix($folder,$add = 0) {
		if(		$this->mail_protocol == "imap" &&
				!preg_match("/^inbox$/i",$folder) && 
				$this->mail_prefix && 
				!preg_match("/^_/",$folder)) {

			if($add) return $this->mail_prefix.$folder;
			else return preg_replace("/^".quotemeta($this->mail_prefix)."/","",$folder);

		} else return $folder;
	}
	
}
require("./inc/class.telaen_mail.php");
?>
