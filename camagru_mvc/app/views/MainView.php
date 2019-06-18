<?php

   class MainView
   {

       function __construct()
       {
           $page_title = 'Main';
           include_once(ROOT . '/public/templates/header.php');
           include_once(ROOT . '/public/templates/footer.php');
       }

   }
?>