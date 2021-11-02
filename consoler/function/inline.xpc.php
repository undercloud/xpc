<?php

if (false === function_exists('xpc_inline')) {
    /**
     * @param $msg
     * @param int $padlength
     * @param bool $firstline
     * @return string
     */
	function xpc_inline ($msg, $padlength = 0, $firstline = true)
	{
		$lines = wordwrap($msg, XPC_TERM_SIZE - $padlength, XPC_PHP_EOL, true);
		$lines = explode(XPC_PHP_EOL, $lines);
		$lines = array_map(
			static function ($index, $line) use ($firstline, $padlength) {
				if (0 === $index and false === $firstline) {
					return $line;
				}

				$line = str_pad($line, XPC_TERM_SIZE - $padlength, ' ');
				$line = str_pad($line, XPC_TERM_SIZE, ' ', STR_PAD_LEFT);

				return $line;
			},
			array_keys($lines),
			$lines
		);

		return implode(XPC_PHP_EOL, $lines);
	}
}
