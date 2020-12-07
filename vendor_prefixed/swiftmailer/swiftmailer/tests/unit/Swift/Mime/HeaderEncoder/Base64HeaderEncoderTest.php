<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

class Swift_Mime_HeaderEncoder_Base64HeaderEncoderTest extends \PHPUnit\Framework\TestCase
{
    //Most tests are already covered in Base64EncoderTest since this subclass only
    // adds a getName() method

    public function testNameIsB()
    {
        $encoder = new Swift_Mime_HeaderEncoder_Base64HeaderEncoder();
        $this->assertEquals('B', $encoder->getName());
    }
}
