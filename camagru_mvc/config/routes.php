<?php

    return array(
        'main' => 'main/index',
        'login' => 'login/index',
        'new'  => 'login/new',
        'signup' => 'signup/index',
        'create' => 'signup/create',
        'success' => 'signup/success',
        'feed' => 'feed/index',
        'logout' => 'login/logout',
        'forgot' => 'password/forgot',
        'reset/([A-Za-z0-9]+)' => "password/reset/1",
        'reset' => 'password/requestReset',
        '' => 'main/index'
    );

?>