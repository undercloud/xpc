<?php
namespace XPC;
/**
 * Class XPCOption
 * @package XPC
 */
class XPCOption
{
    const REQUIRED = ':';

    const OPTIONAL = '::';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $shortName;

    /**
     * @var string
     */
    private $longName;

    /**
     * @var int[]
     */
    private $format = array(0, 0);

    /**
     * @var mixed
     */
    private $defaults;

    /**
     * XPCOption constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        XPCOptionStack::pushStack($name, $this);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $defaults
     */
    public function setDefaults($defaults)
    {
        $this->defaults = $defaults;
    }

    /**
     * @return mixed
     */
    public function getDefaults()
    {
        return $this->defaults;
    }

    /**
     * @param string $longName
     * @param bool $required
     * @return $this
     */
    public function setLongName($longName, $required = true)
    {
        XPCOptionStack::setMaxLongLength($longName);

        $this->longName = $longName;
        $this->longName .= $required ? self::REQUIRED : self::OPTIONAL;

        return $this;
    }

    /**
     * @return string
     */
    public function getLongName()
    {
        return $this->longName;
    }

    /**
     * @param string $shortName
     * @param bool $required
     * @return $this
     */
    public function setShortName($shortName, $required = true)
    {
        XPCOptionStack::setMaxShortLength($shortName);

        $this->shortName = $shortName;
        $this->shortName .= $required ? self::REQUIRED : self::OPTIONAL;

        return $this;
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param int $shortNameLength
     * @param int $longNameLength
     * @return $this
     */
    public function setFormat($shortNameLength, $longNameLength)
    {
        $this->format = array(
            $shortNameLength,
            $longNameLength
        );

        return $this;
    }

    /**
     * @return array
     */
    public function export()
    {
        return array(
            rtrim($this->shortName, ':'),
            rtrim($this->longName, ':')
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $shortName   = $this->shortName ? '-'  . $this->shortName : '';
        $longName    = $this->longName  ? '--' . $this->longName  : '';
        $description = $this->description;

        list($shortLength,$longLength) = $this->format;

        $shortName = str_replace(':', '', $shortName);
        $longName  = str_replace(':', '', $longName);

        $shortName = str_pad($shortName, $shortLength + 1, ' ', STR_PAD_LEFT);
        $longName  = str_pad($longName, $longLength  + 2, ' ', STR_PAD_LEFT);

        $description = xpc_inline(
            $description,
            $shortLength + $longLength + 8 + 2 + 1,
            false
        );

        return (
            xpc_out($shortName, 't-bold', true) . '    ' .
            xpc_out($longName, 't-bold', true)  . '    ' .
            $description
        );
    }
}
