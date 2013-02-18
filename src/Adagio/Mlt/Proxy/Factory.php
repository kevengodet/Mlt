<?php

namespace Adagio\Mlt\Proxy;

use Adagio\Mlt\Exception\UnknownServiceException;

class Factory
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
    public function __construct(Manipulator $manipulator)
    {
        $this->manipulator = $manipulator;
    }

    /**
     * 
     * @param string $name
     * @param array $objectProperties
     * @param array $mltProperties
     * @return Proxy
     */
    public function create($name, $objectProperties, $mltProperties)
    {
        $class = $this->guessClassFromName($name);
        $proxy = $this->createInstance($class);

        if (!array_key_exists('serviceToResource', $properties)) {
            $that = $this;
            $properties['serviceToResource'] = $this->getServiceToResourceClosure();
        }

        if (!array_key_exists('eventDispatcherClosure', $properties)) {
            $that = $this;
            $properties['eventDispatcherClosure'] = $this->getEventDispatcherClosure();
        }

        if ($objectProperties) {
            $this->manipulator->injectProperties($proxy, $objectProperties);
        }

        if ($mltProperties) {
            $this->manipulator->injectResourceProperties($proxy, $mltProperties);
        }

        return $proxy;        
    }

    /**
     * 
     * @param type $name
     * @return type
     */
    private function guessClassFromName($name)
    {
        if (class_exists($name)) {
            return $name;
        }        

        if (class_exists("Adagio\\Mlt\\$name")) {
            return "Adagio\\Mlt\\$name";
        }        

        if (class_exists("Adagio\\Mlt\\Service\\$name")) {
            return "Adagio\\Mlt\\Service\\$name";
        }        

        throw new UnknownServiceException("Unknown service name `$name`.");
    }

    /**
     * Create an instance of a class without invoking the constructor
     * PHP 5.4 version should use ReflectionClass::newInstanceWithoutConstructor
     * @see http://php.net/reflectionclass.newinstancewithoutconstructor
     * 
     * @param type $class
     * @return type
     */
    private function createInstance($class)
    {
        return unserialize(sprintf('O:%d:"%s":0:{}', strlen($class), $class));
    }
}