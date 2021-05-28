<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

Swift_DependencyContainer::getInstance()
    ->register('message.message')
    ->asNewInstanceOf('Swift_Message')

    ->register('message.mimepart')
    ->asNewInstanceOf('Swift_MimePart')
;
