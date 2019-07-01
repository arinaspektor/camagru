<?php

    class Mail
    {
 
        static public function send($to, $subject, $text, $headers)
        {
             return mail($to, $subject, $text, $headers);
        }

    }
 

?>