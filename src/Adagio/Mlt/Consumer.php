<?php

namespace Adagio\Mlt;

use Adagio\Mlt\Event\Event;

class Consumer extends Service
{
    /**
     *
     * @var float
     */
    private $startTime;

    /**
     * 
     * @return int
     */
    public function getPosition()
    {
        return Consumer_position($this->_cPtr);
    }

    /**
     * 
     * @param \Adagio\Mlt\Producer $producer
     * @return boolean
     */
    public function connect(Producer $producer)
    {
        return Consumer_connect($this->_cPtr, $this->serviceToResource->__invoke($producer));
    }

    /**
     * 
     * @return boolean
     */
    public function start()
    {
        $this->startTime = microtime(true);

        return Consumer_start($this->_cPtr);
    }

    public function stop()
    {
        return consumer_stop($this->_cPtr);
    }

    /**
     * Waits until the consumer stops
     */
    public function wait()
    {
        while (!$this->isStopped()) {
            usleep(100000);
            if (time() - $start > $timeout) {
                $this->stop();
            }
        }
    }

    public function getProgress()
    {
        consumer_position();
    }

    /**
     * 
     * @return float
     */
    public function getRuningTime()
    {
        if ($this->isStopped()) {
            return null;
        }

        return microtime(true) - $this->startTime;
    }

    /**
     * 
     * @return boolean
     */
    public function isStopped()
    {
        return Consumer_is_stopped($this->_cPtr);
    }

    public function dump()
    {
        properties_dump($this->getPropertiesResource());
    }
}