<?php

if (false === function_exists('xpc_catch')) {
	function xpc_catch(callable $handler = null)
	{
		$proxy = function (array $arguments) use ($handler) {
			if ($handler) {
				$handler($arguments);
			}

			$error = (
				'--- ERROR ' . str_repeat('-', XPC_TERM_SIZE - 6) . XPC_PHP_EOL .
				' Type   : ' . xpc_inline($arguments['type'], 10, false) . XPC_PHP_EOL .
				' Code   : ' . xpc_inline($arguments['code'], 10, false) . XPC_PHP_EOL .
				' Message: ' . xpc_inline($arguments['message'], 10, false) . XPC_PHP_EOL .
				' File   : ' . xpc_inline($arguments['file'], 10, false) . XPC_PHP_EOL .
				' Line   : ' . xpc_inline($arguments['line'], 10, false) . XPC_PHP_EOL
			);

			xpc_outln($error, 'f-red');
		};

		$exceptionHandler = static function ($exception) use ($proxy) {
			$proxy(array(
				'type'    => get_class($exception),
				'code'    => $exception->getCode(),
				'message' => $exception->getMessage(),
				'file'    => $exception->getFile(),
				'line'    => $exception->getLine(),
			));
		};

		set_exception_handler($exceptionHandler);

		$errorHandler = static function ($code, $msg, $file, $line) use ($proxy) {
			if (!(error_reporting() & $code)) {
				return false;
    		}

			$errors = array(
				1     => "E_ERROR",
	  			2     => "E_WARNING",
				4     => "E_PARSE",
				8     => "E_NOTICE",
				16    => "E_CORE_ERROR",
				32    => "E_CORE_WARNING",
				64    => "E_COMPILE_ERROR",
				128   => "E_COMPILE_WARNING",
				256   => "E_USER_ERROR",
				512   => "E_USER_WARNING",
				1024  => "E_USER_NOTICE",
				2048  => "E_STRICT",
				4096  => "E_RECOVERABLE_ERROR",
				8192  => "E_DEPRECATED",
				16384 => "E_USER_DEPRECATED",
				32767 => "E_ALL"
			);

			$proxy(array(
				'type'    => $errors[$code],
				'code'    => $code,
				'message' => $msg,
				'file'    => $file,
				'line'    => $line
			));
		};

		set_error_handler($errorHandler, error_reporting());
	}
}
