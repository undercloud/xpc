<?php

if (false === function_exists('xpc_arg')) {
	function xpc_arg($name)
	{
		return new XPC\XPCOption($name);
	}
}
