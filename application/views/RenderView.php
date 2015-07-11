<?php
class RenderView
{
    public static function render($file) {
        ob_start();
        include "/".$file.".tpl";
        return ob_get_clean();
    }
}