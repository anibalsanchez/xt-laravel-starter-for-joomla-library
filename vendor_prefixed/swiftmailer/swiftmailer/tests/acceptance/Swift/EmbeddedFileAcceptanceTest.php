<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

require_once 'swift_required.php';
require_once __DIR__.'/Mime/EmbeddedFileAcceptanceTest.php';

class Swift_EmbeddedFileAcceptanceTest extends Swift_Mime_EmbeddedFileAcceptanceTest
{
    protected function createEmbeddedFile()
    {
        return new Swift_EmbeddedFile();
    }
}
