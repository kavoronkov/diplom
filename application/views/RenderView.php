<?php
class RenderView
{
    public static function render($file) {
        ob_start();
        require_once "/".$file.".tpl";
        return ob_get_clean();
    }
}