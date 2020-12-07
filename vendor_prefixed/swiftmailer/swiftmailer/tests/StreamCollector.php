<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

class Swift_StreamCollector
{
    public $content = '';

    public function __invoke($arg)
    {
        $this->content .= $arg;
    }
}
