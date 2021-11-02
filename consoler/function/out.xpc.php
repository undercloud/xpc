<?php

if (false === function_exists('xpc_outln')) {
    function xpc_outln ($msg = '', $style = null)
    {
        xpc_out($msg . XPC_PHP_EOL, $style);
    }
}

if (false === function_exists('xpc_out')) {
    function xpc_out($msg, $style = null, $return = false)
    {
        if(!$style){
            $style = 'f-default:b-default';
        }

        if (is_array($msg)) {
            return array_map('xpc_outln', $msg);
        }

        if(XPC_COLORIZE_ENABLED){
            static $map = array(
                't-bold'       => 1,
                't-underlined' => 4,

                'f-black'  => 30, 'f-red'   => 31, 'f-green'   => 32,
                'f-yellow' => 33, 'f-blue'  => 34, 'f-purple'  => 35,
                'f-cyan'   => 36, 'f-white' => 37, 'f-default' => 39,

                'b-black'  => 40, 'b-red'   => 41, 'b-green'   => 42,
                'b-yellow' => 43, 'b-blue'  => 44, 'b-purple'  => 45,
                'b-cyan'   => 46, 'b-white' => 47, 'b-default' => 49,
            );

            $keys = explode(':', (string) $style);
            $keys = array_map(
                static function ($key) use ($map) {
                    return array_key_exists($key, $map)
                        ? $map[$key]
                        : null;
                },
                $keys
            );
            
            $keys = array_filter($keys);
            $style = implode(';', $keys ? $keys : array(0,39,49));

            $msg = sprintf("\033[%sm%s\e[0;39;49m", $style, $msg);
        }
           
        if ($return) {
            return $msg;
        }

        fwrite(STDOUT, $msg);
    }
}
