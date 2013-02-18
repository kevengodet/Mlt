<?php

namespace Adagio\Mlt\Proxy;

class Manipulator
{
    /**
     *
     * @var Registry
     */
    private $registry;

    /**
     * 
     * @param Registry $registry
     */
    public function setRegistry(Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * Inject a value in a protected of private property of a proxy
     *
     * @param Proxy $proxy
     * @param property $property
     * @param mixed $value
     * @return boolean
     */
    public function injectProperty(Proxy $proxy, $property, $value)
    {
        $r = new \ReflectionObject($proxy);

        if (!$r->hasProperty($property)) {
            return false;
        }

        $p = $r->getProperty($property);
        $p->setAccessible(true);
        $p->setValue($proxy, $value);
    }

    /**
     * 
     * @param Proxy $proxy
     * @param array $properties
     */
    public function injectProperties(Proxy $proxy, $properties)
    {
        foreach ($properties as $property => $value) {
            $this->injectProperty($proxy, $property, $value);
        }
    }

    /**
     * 
     * @param resource $resource
     * @param array $properties
     */
    public function injectResourceProperties(Proxy $proxy, $properties)
    {
        if (!$this->registry) {
            throw new \RuntimeException('Proxy manipulator requires a Registry instance to inject properties into resource.');
        }

        $ptrProperties = new_properties($this->registry->getResource($proxy));
        foreach ($properties as $name => $value) {
            properties_set($ptrProperties, $name, $value);
        }
    }
}