<?php

    class Session {
        
        static public function start()
        {
            session_start();
        }

        static public function destroy()
        {
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            session_destroy();
        }
    }

?>