<?php

    class View
    {
        static public function generate($content_view, $template_view, $view_data = [])
        {
            include 'app/views/templates/' . $template_view;
        }
    }

?>