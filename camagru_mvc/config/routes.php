<?php

    return array(
        'main' => 'main/index',
        'login' => 'login/index',
        'new'  => 'login/new',
        'signup' => 'signup/index',
        'create' => 'signup/create',
        'success' => 'signup/success',
        'profile' => 'profile/index',
        'settings' => 'profile/settings',
        'edit' => 'profile/edit',
        'getstarted/([A-Za-z0-9]+)' => 'signup/confirm/1',
        'requestConfirm' => 'signup/requestConfirm',
        'reConfirm' => 'signup/reConfirm',
        'feed' => 'feed/index',
        'logout' => 'login/logout',
        'forgot' => 'password/forgot',
        'reset/passwd' => 'password/passReset',
        'reset/([A-Za-z0-9]+)' => 'password/reset/1',
        'reset' => 'password/requestReset',
        'upload_ava' => 'profile/uploadAva',
        'post/([0-9]+)' => 'post/index/1',
        'post' => 'post/newPhoto',
        'delete' => 'post/deletePost',
        'comment' => 'post/addComment',
        'like' => 'post/addLike',
        'view/([0-9]+)' => 'post/getPostInfo/1',
        '' => 'main/index'
    );

?>
