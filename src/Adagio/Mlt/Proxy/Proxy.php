<?php

namespace Adagio\Mlt\Proxy;

abstract class Proxy
{
    /**
     *
     * @var resource of type _p_Mlt__?
     */
    protected $_cPtr;

    /**
     *
     * @var resource of type _p_Mtl__Properties
     */
    protected $_cPtrProperties;

    /**
     *
     * @var Closure
     */
    protected $serviceToResource;

    /**
     *
     * @var \Symfony\Component\EventDispatcher\EventDispatcher 
     */
    protected $eventDispatcher;

    private function __construct()
    {
        
    }

    /**
     * 
     * @return resource of type _p_Mtl__Properties
     */
    protected function getPropertiesResource()
    {
        if (!$this->_cPtrProperties) {
            $this->_cPtrProperties = new_Properties($this->_cPtr);
        }

        return $this->_cPtrProperties;
    }

    /**
     * Emit an event, or fail silently if no EventDispatcher instance is set
     */
    protected function emit()
    {
        if ($this->eventDispatcher) {
            // emit event
        }
    }

    /**
     * 
     * @param string $name
     * @param mixed $value
     * @return boolean
     */
    public function setProperty($name, $value)
    {
        return properties_set($this->getPropertiesResource(), $name, $value);
    }

    public function dump($return = false)
    {
        properties_dump($this->getPropertiesResource());
    }
}