<?php
namespace XPC;
/**
 * Class XPCOptionStack
 * @package XPC
 */
class XPCOptionStack
{
    /**
     * @var int
     */
    private static $maxShortLength = 0;

    /**
     * @var int
     */
    private static $maxLongLength = 0;

    /**
     * @var array
     */
    private static $stack = array();

    /**
     * @param string $name
     * @param XPCOption $xpcOption
     */
    public static function pushStack($name, XPCOption $xpcOption)
    {
        self::$stack[$name] = $xpcOption;
    }

    /**
     * @param int $maxShortLength
     */
    public static function setMaxShortLength($maxShortLength)
    {
        self::$maxShortLength = max(
            self::$maxShortLength,
            strlen($maxShortLength)
        );
    }

    /**
     * @param int $maxLongLength
     */
    public static function setMaxLongLength($maxLongLength)
    {
        self::$maxLongLength = max(
            self::$maxLongLength,
            strlen($maxLongLength)
        );
    }

    /**
     * @return array
     */
    public static function exportStack()
    {
        return self::$stack;
    }

    /**
     * @return array
     */
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

    /**
     * @return string
     */
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
