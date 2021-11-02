<?php
namespace XPC;

class XPCOption
{
    const REQUIRED = ':';

    const OPTIONAL = '::';

    private $name;

    private $description;

    private $shortName;

    private $longName;

    private $format = array(0, 0);

    private $defaults;

    public function __construct($name)
    {
        $this->name = $name;
        XPCOptionStack::pushStack($name, $this);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDefaults($defaults)
    {
        $this->defaults = $defaults;
    }

    public function getDefaults()
    {
        return $this->defaults;
    }

    public function setLongName($longName, $required = true)
    {
        XPCOptionStack::setMaxLongLength($longName);

        $this->longName = $longName;
        $this->longName .= $required ? self::REQUIRED : self::OPTIONAL;

        return $this;
    }

    public function getLongName()
    {
        return $this->longName;
    }

    public function setShortName($shortName, $required = true)
    {
        XPCOptionStack::setMaxShortLength($shortName);

        $this->shortName = $shortName;
        $this->shortName .= $required ? self::REQUIRED : self::OPTIONAL;

        return $this;
    }

    public function getShortName()
    {
        return $this->shortName;
    }

    public function setFormat($shortNameLength, $longNameLength)
    {
        $this->format = array(
            $shortNameLength,
            $longNameLength
        );

        return $this;
    }

    public function export()
    {
        return array(
            rtrim($this->shortName, ':'),
            rtrim($this->longName, ':')
        );
    }

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
