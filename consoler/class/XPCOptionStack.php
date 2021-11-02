<?php
namespace XPC;

class XPCOptionStack
{
    private static $maxShortLength = 0;

    private static $maxLongLength = 0;

    private static $stack = array();

    public static function pushStack($name, XPCOption $xpcOption)
    {
        self::$stack[$name] = $xpcOption;
    }

    public static function setMaxShortLength($maxShortLength)
    {
        self::$maxShortLength = max(
            self::$maxShortLength,
            strlen($maxShortLength)
        );
    }

    public static function setMaxLongLength($maxLongLength)
    {
        self::$maxLongLength = max(
            self::$maxLongLength,
            strlen($maxLongLength)
        );
    }

    public static function exportStack()
    {
        return self::$stack;
    }

    public static function exportOptions()
    {
        $shortOptions = '';
        $longOptions  = array();

        foreach (self::$stack as $xpcOption) {
            $shortOptions .= $xpcOption->getShortName();
            $longOptions[] = $xpcOption->getLongName();
        }

        return array($shortOptions, $longOptions);
    }

    public function __toString()
    {
        foreach (self::$stack as $xpcOption) {
            $xpcOption->setFormat(
                self::$maxShortLength,
                self::$maxLongLength
            );
        }

        return implode(XPC_PHP_EOL, self::$stack);
    }
}
