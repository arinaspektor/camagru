<?php

    class Flash
    {
        static public function addMessage($message)
        {
            $_SESSION['flash'] = $message;
        }


        static public function getMessage()
        {
            if (isset($_SESSION['flash'])) {
                $message = $_SESSION['flash'];
                unset($_SESSION['flash']);

                return $message;
            }
        }

    }


?>