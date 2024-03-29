<?php

if (false === function_exists('xpc_progress')) {
    /**
     * @param $done
     * @param $total
     * @param null $text
     * @return void
     */
	function xpc_progress($done, $total, $text = null)
    {
		if (!$total) {
            return;
        }

        $width = 20;
    	$percent = round(($done * 100) / $total);
    	$bar = round(($width * $percent) / 100);
    	
        $bar_sign   = '#';
        $empty_sign = '-';
    	$filled     = xpc_out(str_repeat($bar_sign, (int) $bar), 'f-green', true);
    	$empty      = str_repeat($empty_sign, ((($diff = $width - $bar) > 0) ? $diff : 0));

        $done    = round($done, 2);
        $total   = round($total, 2);
        $percent = round($percent, 2);
        $len     = strlen((string) $total) + 3;

    	$msg = sprintf(
    		" %' {$len}s / %s [%s%s] %3d%%",
    		$done,
    		$total,
    		$filled,
    		$empty,
            $percent
    	);

        if (false === is_null($text)) {
            $free = XPC_TERM_SIZE - strlen($msg);
            $text = xpc_trim(' ' . $text, $free);
            $text = str_pad($text, $free);
        }
        
    	xpc_out($msg . $text);
	}
}
