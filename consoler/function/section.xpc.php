<?php

if (false === function_exists('xpc_section')) {
	function xpc_section ($title, $text)
	{
		$title = (string) $title;
		$text  = (string) $text;

		$text = xpc_inline($text, XPC_PADDING, true);

		xpc_outln($title, 't-bold');
		xpc_outln($text);
		xpc_outln();
	}
}
