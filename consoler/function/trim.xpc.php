<?php

if (false === function_exists('xpc_trim')) {
    /**
     * @param $string
     * @param int $limit
     * @return string
     */
	function xpc_trim($string, $limit = XPC_TERM_SIZE)
	{
        $len = strlen($string);
        if ($len > $limit) {
            $mid = (int) (($limit - 3) / 2);
            return (
                substr($string, 0, $mid) .
                '...' .
                substr($string, $len - $mid, $len)
            );
        }

        return $string;
    }
}
