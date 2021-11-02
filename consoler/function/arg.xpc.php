<?php

if (false === function_exists('xpc_arg')) {
    /**
     * @param $name
     * @return \XPC\XPCOption
     */
	function xpc_arg($name)
	{
		return new XPC\XPCOption($name);
	}
}
