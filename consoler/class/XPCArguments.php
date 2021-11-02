<?php
namespace XPC;
/**
 * @class XPCArguments 
 */
class XPCArguments
{
    /**
     * @var array
     */
    private $arguments;

    /**
     * XPCArguments constructor.
     * @param array $arguments
     */
    public function __construct(array $arguments)
    {
        $this->arguments = $arguments;
    }

    /**
     * @param $name
     * @return bool|mixed
     */
    public function __get($name)
    {
        $stack = XPCOptionStack::exportStack();

        if (isset($stack[$name])) {
            list($shortKey, $longKey) = $stack[$name]->export();

            $defaults = $stack[$name]->getDefaults();

            if (isset($this->arguments[$shortKey])) {
                return false !== $this->arguments[$shortKey]
                    ? $this->arguments[$shortKey]
                    : (isset($defaults) ? $defaults : true);
            }

            if (isset($this->arguments[$longKey])) {
                return false !== $this->arguments[$longKey]
                    ? $this->arguments[$longKey]
                    : (isset($defaults) ? $defaults : true);
            }

            return $defaults;
        }
    }
}
