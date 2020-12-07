<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

require_once 'swift_required.php';
require_once __DIR__.'/Mime/AttachmentAcceptanceTest.php';

class Swift_AttachmentAcceptanceTest extends Swift_Mime_AttachmentAcceptanceTest
{
    protected function createAttachment()
    {
        return new Swift_Attachment();
    }
}
