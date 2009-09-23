<?php
class PHPMailer_extra extends PHPMailer {

    /**
     *  Read only - return a formatted mail to the client
     *  @var string
     */
    var $FormattedMail   = "";
    var $LE              = "\n";

    function Send() {
        $header = "";
        $body = "";
        $result = true;

        if((count($this->to) + count($this->cc) + count($this->bcc)) < 1)
        {
            $this->SetError($this->Lang("provide_address"));
            return false;
        }

        // Set whether the message is multipart/alternative
        if(!empty($this->AltBody))
            $this->ContentType = "multipart/alternative";

        $this->error_count = 0; // reset errors
        $this->SetMessageType();
        $header .= $this->CreateHeader();
        $body = $this->CreateBody();

        if($body == "") { return false; }

        $fheader = $header;

        // In PHPMailer, when we use the 'mail' Mailer type,
        // the To and Subject lines aren't added to the header,
        // thus we don't see them in the SENT folder. So, in
        // this case, force them in. Also, some other headers
        // aren't correct, so fix 'em
        if ($this->Mailer == "mail") {
            if (count($this->to) > 0)
                $fheader .= $this->AddrAppend("To", $this->to);
            else
                $fheader .= $this->HeaderLine("To", "undisclosed-recipients:;");

            // Add in the Subject and CC lines
            $fheader .= $this->HeaderLine("Subject", $this->EncodeHeader(trim($this->Subject)));
            if(count($this->cc) > 0) {
                $fheader .= $this->AddrAppend("Cc", $this->cc);
                if ($this->Version < 2) {
                    $header .= $this->AddrAppend("Cc", $this->cc);
                }
            }
        }
        $this->FormattedMail = sprintf("%s\r\n\r\n%s",$fheader,$body);

        // Choose the mailer
        switch($this->Mailer)
        {
            case 'sendmail':
                $result = $this->SendmailSend($header, $body);
                break;
            case 'smtp':
                $result = $this->SmtpSend($header, $body);
                break;
            case 'mail':
                $result = $this->MailSend($header, $body);
                break;
            default:
                $result = $this->MailSend($header, $body);
                break;
        }

        return $result;
    }
}

?>
