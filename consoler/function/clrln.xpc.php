<?php

if (false === function_exists('xpc_clrln')) {
    /**
     * @return void
     */
	function xpc_clrln()
	{
		xpc_out(XPC_PHP_CR);
	}
}
