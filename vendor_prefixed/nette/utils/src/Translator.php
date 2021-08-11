<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Extly\Nette\Localization;


/**
 * Translator adapter.
 */
interface Translator
{
	/**
	 * Translates the given string.
	 * @param  mixed  $message
	 * @param  mixed  ...$parameters
	 */
	function translate($message, ...$parameters): string;
}


interface_exists(Nette\Localization\ITranslator::class);
