<?php

    class View
    {
        static public function generate($content_view, $template_view, $view_data = [])
        {
            $view_data['flash'] = Flash::getMessage();

            include 'app/views/templates/' . $template_view;
        }
    }

?>