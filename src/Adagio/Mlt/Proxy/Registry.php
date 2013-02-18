<?php

namespace Adagio\Mlt\Proxy;

use Adagio\Mlt\Exception\UnregisteredProxyException;

class Registry extends \SplObjectStorage
{
    /**
     *
     * @var Manipulator
     */
    private $manipulator;

    /**
     * 
     * @param Manipulator $manipulator
     */
    public function __construct(Manipulator $manipulator = null)
    {
        if ($manipulator) {
            $this->setManipulator($manipulator);
        }
    }

    /**
     * 
     * @param Manipulator $manipulator
     */
    public function setManipulator(Manipulator $manipulator)
    {
        $manipulator->setRegistry($this);
        $this->manipulator = $manipulator;
    }

    /**
     * 
     * @param string $property
     * @param mixed $value
     */
    public function injectProperty($property, $value)
    {
        foreach ($this as $proxy) {
            $this->manipulator->injectProperty($proxy, $property, $value);
        }
    }

    /**
     * 
     * @param Proxy $proxy
     * @return resource
     * @throws UnregisteredProxyException
     */
    public function getResource(Proxy $proxy)
    {
        if (!$this->contains($proxy)) {
            throw new UnregisteredProxyException("The proxy `$proxy` is not registered.");
        }

        return $this[$proxy];
    }
}