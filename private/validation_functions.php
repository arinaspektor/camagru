<?php

    // Filter_var instead of preg_match
    function valid_email_format($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function passwd_confirmation($pswd, $dup_pswd):bool {
        return $pswd === $dup_pswd;
    }

    function check_data($data) {
        $errors = [];
        return $errors;
    }

?>