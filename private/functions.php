<?php

  function redirect($url) {
    header("Location: $url");
  }

  function include_header($is_loggedin, $page_title) {
    $to_include = $is_loggedin ? '/user_header.php' : '/public_header.php';
    include('../private/shared' . $to_include);
  }

?>
