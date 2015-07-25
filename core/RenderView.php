<?php
class RenderView
{
    public function render($file) {
        ob_start();
        include "/".$file.".phtml";
        return ob_get_clean();
    }
}