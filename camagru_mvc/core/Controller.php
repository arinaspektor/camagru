<?php

    abstract class Controller
    {
        public $view;
        public $view_data = [];

        public function __construct()
        {
            $this->view = new View();
        }

    }

?>