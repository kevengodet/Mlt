<?php

namespace Adagio\Mlt;

use Adagio\Mlt\Service\Registry;
use Adagio\Mlt\Service\Factory;
use Adagio\Mlt\Util\ObjectManipulator;

class Mlt
{
    const VERSION = \LIBMLT_VERSION;
    const VERSION_MAJOR = \LIBMLT_VERSION_MAJOR;
    const VERSION_MINOR = \LIBMLT_VERSION_MINOR;
    const VERSION_REVISION = \LIBMLT_VERSION_REVISION;
    const VERSION_INT = \LIBMLT_VERSION_INT;
    const LOG_QUIET = -8;

    /**
     * something went really wrong and we will crash now
     */
    const LOG_PANIC = 0;

    /**
     * something went wrong and recovery is not possible
     * like no header in a format which depends on it or a combination
     * of parameters which are not allowed
     */
    const LOG_FATAL = 8;

    /**
     * something went wrong and cannot losslessly be recovered
     * but not all future data is affected
     */
    const LOG_ERROR = 16;

    /**
     * something somehow does not look correct / something which may or may not
     * lead to some problems
     */
    const LOG_WARNING = 24;
    const LOG_INFO = 32;
    const LOG_VERBOSE = 40;

    /**
     * stuff which is only useful for MLT developers
     */
    const LOG_DEBUG = 48;

    /**
     *
     * @var array of object_hash => pointer
     */
    private $ptrRepository = array();

    /**
     *
     * @var Closure
     */
    private $serviceToResource;

    /**
     *
     * @var Closure
     */
    private $eventDispatcherClosure;

    /**
     *
     * @var \Symfony\Component\EventDispatcher\EventDispatcher
     */
    private $eventDispatcher;

    /**
     *
     * @var _p_Mlt__Profile
     */
    private $currentProfile;

    /**
     *
     * @var Registry
     */
    private $serviceRegistry;

    /**
     *
     * @var Factory
     */
    private $serviceFactory;

    /**
     *
     * @param string $directory Location of the installed modules
     * @param Registry $serviceRegistry
     * @param Factory $serviceFactory
     */
    public function __construct($directory = null, $serviceRegistry = null, $serviceFactory = null)
    {
        $this->initialize($directory, $serviceRegistry, $serviceFactory);
    }

    /**
     *
     * @param string $directory Location of the installed modules
     * @param Registry $serviceRegistry
     * @param Factory $serviceFactory
    */
    private function initialize($directory, $serviceRegistry, $serviceFactory)
    {
        mlt_factory_init($directory);

        $this->serviceRegistry = is_null($serviceRegistry) ?
                                    new Registry(new ObjectManipulator()) :
                                    $serviceRegistry;

        $this->serviceFactory = is_null($serviceFactory) ?
                                    new Factory(new ObjectManipulator()) :
                                    $serviceFactory;
    }

    /**
     *
     * @param string $name
     * @return Profile
     */
    public function profile($name = null)
    {
        $this->currentProfile = new_Profile($name);
        $profile = $this->factory('Adagio\\Mlt\\Profile', array('_cPtr' => $this->currentProfile));
        $this->ptrRepository[spl_object_hash($profile)] = $this->currentProfile;

        return $profile;
    }

    /**
     *
     * @param string $name
     * @param array $options
     * @return Producer
     */
    public function producer($name, $options = array())
    {
        $profile = $this->retrieveProfileFromOptions($options);
        $cPtr = new_Producer($profile, $name);
        if (!Properties_is_valid($cPtr)) {
            throw new \InvalidArgumentException("Unable to open `$name` producer.");
        }

        $this->setResourceProperties($cPtr, $options);

        $producer = $this->factory('Adagio\\Mlt\\Producer', array('_cPtr' => $cPtr));
        $this->ptrRepository[spl_object_hash($producer)] = $cPtr;
        $cPtr = null;

        return $producer;
    }

    /**
     *
     * @param string $name
     * @param array $options
     * @return Consumer
     */
    public function consumer($name = null, $options = array())
    {
        $profile = $this->retrieveProfileFromOptions($options);
        $cPtr = new_Consumer($profile, $name);
        if (!Properties_is_valid($cPtr)) {
            throw new \InvalidArgumentException("Unable to open `$name` consumer.");
        }

        $this->setResourceProperties($cPtr, $options);

        $consumer = $this->factory('Adagio\\Mlt\\Consumer', array('_cPtr' => $cPtr));
        $this->ptrRepository[spl_object_hash($consumer)] = $cPtr;
        $cPtr = null;

        return $consumer;
    }

    /**
     * 
     * @return int
     */
    public function getLogLevel()
    {
        return mlt_log_get_level();
    }

    /**
     * 
     * @param int $level
     * @throws \InvalidArgumentException
     */
    public function setLogLevel($level)
    {
        $levels = array(self::LOG_QUIET, self:: LOG_PANIC, self::LOG_FATAL, self::LOG_ERROR, self::LOG_WARNING, self::LOG_INFO, self::LOG_VERBOSE, self::LOG_DEBUG);
        if (!in_array($level, $levels)) {
            throw new \InvalidArgumentException(sprintf('Log level must be one in [%s].', implode(', ', $levels)));
        }
        mlt_log_set_level($level);
    }

    /**
     * 
     * @param resource $resource
     * @param array $properties
     */
    private function setResourceProperties($resource, $properties)
    {
        $ptrProperties = new_properties($resource);
        foreach ($properties as $name => $value) {
            properties_set($ptrProperties, $name, $value);
        }
    }

    /**
     * 
     * @param array $options
     * @return resoruce of type _p_Mlt__Profile
     * @throws \InvalidArgumentException
     */
    private function retrieveProfileFromOptions(&$options)
    {
        if (array_key_exists('profile', $options)) {
            if (!$options['profile'] instanceof Profile) {
                throw new \InvalidArgumentException('`profile` option must be an instance of Profile class.');
            }
            return $this->ptrRepository[spl_object_hash($options['profile'])];
            unset($options['profile']);
        } elseif ($this->currentProfile) {
            return $this->currentProfile;
        }

        throw new \InvalidArgumentException('Profile instance required.');
    }

    /**
     * 
     * @return Closure
     */
    private function getServiceToResourceClosure()
    {
        if (!$this->serviceToResource) {
            $property = new \ReflectionProperty(__CLASS__, 'ptrRepository');
            $property->setAccessible(true);
            $that = $this;

            /**
             * PHP 5.4 version should use Closure::bindTo
             * @see http://php.net/closure.bindto
             */
            $this->serviceToResource = function(Service $service) use ($that, $property) {
                        $repository = $property->getValue($that);
                        $hash = spl_object_hash($service);
                        if (!array_key_exists($hash, $repository)) {
                            throw new \OutOfRangeException(sprintf('Service `%s` with hash `%s` is not referenced in Mlt service repository.', get_class($service), $hash));
                        }

                        return $repository[$hash];
                    };
            $repository = null;
            $that = null;
        }

        return $this->serviceToResource;
    }

    /**
     * 
     * @return Closure
     */
    private function getEventDispatcherClosure()
    {
        if (!$this->eventDispatcherClosure) {
            $that = $this;
            $this->eventDispatcherClosure = function () use ($that) {
                return $that->getEventDispatcher();
            };
        }

        return $this->eventDispatcherClosure;
    }

    /**
     * 
     * @return \Symfony\Component\EventDispatcher\EventDispatcher
     */
    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }

    /**
     * 
     * @return \Symfony\Component\EventDispatcher\EventDispatcher
     */
    public function setEventDispatcher(\Symfony\Component\EventDispatcher\EventDispatcher $dispatcher)
    {
        $this->eventDispatcher = $dispatcher;
    }

    /**
     * 
     * @param string $class
     * @param array $properties
     * @return object
     */
    private function factory($class, $properties = array())
    {
        $r = new \ReflectionClass($class);

        /**
         * PHP 5.4 version should use ReflectionClass::newInstanceWithoutConstructor
         * @see http://php.net/reflectionclass.newinstancewithoutconstructor
         */
        $instance = unserialize(sprintf('O:%d:"%s":0:{}', strlen($class), $class));

        if (!array_key_exists('serviceToResource', $properties)) {
            $that = $this;
            $properties['serviceToResource'] = $this->getServiceToResourceClosure();
        }

        if (!array_key_exists('eventDispatcherClosure', $properties)) {
            $that = $this;
            $properties['eventDispatcherClosure'] = $this->getEventDispatcherClosure();
        }

        foreach ($properties as $name => $value) {
            $prop = $r->getProperty($name);
            $prop->setAccessible(true);
            $prop->setValue($instance, $value);

            $prop = null;
        }

        $class = null;

        return $instance;
    }

    public function __destruct()
    {
        foreach (array_keys($this->ptrRepository) as $hash) {
            $this->ptrRepository[$hash] = null;
            unset($this->ptrRepository[$hash]);
        }
        mlt_factory_close();
    }
}