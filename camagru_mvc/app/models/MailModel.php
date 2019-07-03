<?php

    class Mail
    {
        public $headers;
        public $to;

        private function __construct()
        {
            $this->to  = $_SESSION['user_email'];
            $this->headers = 'From: noreply@camagru' . "\r\n";
            $this->headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        }

        static public function send($to, $subject, $text, $headers)
        {
             return mail($to, $subject, $text, $headers);
        }


        static public function confirmAccount($url)
        {
            $mail = new self;
            $subject = "Account confirmation"; 
            
            $text = "
            <h4>Hi!</h4>

            <p>Your email was provided for registration on Camagru and you were successfully registered.</p>
            
            <p>To confirm your email please follow the <a href = $url>link</a>.</p>
            
            <p>After that, please, login into the system.</p>
            
            <p>If it was not you, just ignore this letter.</p>
            
            <p>Thank you for joining to Camagru!</p>"; 
           
            return self::send($mail->to, $subject, $text, $mail->headers);
        }


        static public function resetPassword($url)
        {
            $mail = new self;
            $subject = "Password recovery";

            $text = "
            <h4>Hi!</h4>

            <p>To change your Camagru password, click <a href = $url>here</a>.</p>

            <p>This link will expire in 24 hours, so be sure to use it right away.</p>

            <p>Thank you for using Camagru!</p>";

            return self::send($mail->to, $subject, $text, $mail->headers);
        }

    }
 

?>