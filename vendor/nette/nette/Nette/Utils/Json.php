<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 * Copyright (c) 2004 David Grudl (http://davidgrudl.com)
 */

namespace Nette\Utils;

use Nette;


/**
 * JSON encoder and decoder.
 *
 * @author     David Grudl
 */
class Json
{
	const FORCE_ARRAY = 1;
	const PRETTY = 2;

	/** @var array */
	private static $messages = array(
		JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded',
		JSON_ERROR_STATE_MISMATCH => 'Syntax error, malformed JSON',
		JSON_ERROR_CTRL_CHAR => 'Unexpected control character found',
		JSON_ERROR_SYNTAX => 'Syntax error, malformed JSON',
		5 /*JSON_ERROR_UTF8*/ => 'Invalid UTF-8 sequence',
		6 /*JSON_ERROR_RECURSION*/ => 'Recursion detected',
		7 /*JSON_ERROR_INF_OR_NAN*/ => 'Inf and NaN cannot be JSON encoded',
		8 /*JSON_ERROR_UNSUPPORTED_TYPE*/ => 'Type is not supported',
	);


	/**
	 * Static class - cannot be instantiated.
	 */
	final public function __construct()
	{
		throw new Nette\StaticClassException;
	}


	/**
	 * Returns the JSON representation of a value.
	 * @param  mixed
	 * @param  int  accepts Json::PRETTY
	 * @return string
	 */
	public static function encode($value, $options = 0)
	{
		if (function_exists('ini_set')) { // workaround for PHP bugs #52397, #54109, #63004
			$old = ini_set('display_errors', 0); // needed to receive 'Invalid UTF-8 sequence' error
		}
		set_error_handler(function($severity, $message) { // needed to receive 'recursion detected' error
			restore_error_handler();
			throw new JsonException($message);
		});
		$json = json_encode(
			$value,
			PHP_VERSION_ID >= 50400 ? (JSON_UNESCAPED_UNICODE | ($options & self::PRETTY ? JSON_PRETTY_PRINT : 0)) : 0
		);
		restore_error_handler();
		if (isset($old)) {
			ini_set('display_errors', $old);
		}
		if ($error = json_last_error()) {
			throw new JsonException(isset(static::$messages[$error]) ? static::$messages[$error] : 'Unknown error', $error);
		}
		$json = str_replace(array("\xe2\x80\xa8", "\xe2\x80\xa9"), array('\u2028', '\u2029'), $json);
		return $json;
	}


	/**
	 * Decodes a JSON string.
	 * @param  string
	 * @param  int  accepts Json::FORCE_ARRAY
	 * @return mixed
	 */
	public static function decode($json, $options = 0)
	{
		$json = (string) $json;
		if (!preg_match('##u', $json)) {
			throw new JsonException('Invalid UTF-8 sequence', 5); // workaround for PHP < 5.3.3 & PECL JSON-C
		}

		$args = array($json, (bool) ($options & self::FORCE_ARRAY));
		$args[] = 512;
		if (PHP_VERSION_ID >= 50400 && !(defined('JSON_C_VERSION') && PHP_INT_SIZE > 4)) { // not implemented in PECL JSON-C 1.3.2 for 64bit systems
			$args[] = JSON_BIGINT_AS_STRING;
		}
		$value = call_user_func_array('json_decode', $args);

		if ($value === NULL && $json !== '' && strcasecmp($json, 'null')) { // '' do not clean json_last_error
			$error = json_last_error();
			throw new JsonException(isset(static::$messages[$error]) ? static::$messages[$error] : 'Unknown error', $error);
		}
		return $value;
	}

}


/**
 * The exception that indicates error of JSON encoding/decoding.
 */
class JsonException extends \Exception
{
}
