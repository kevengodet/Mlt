<?php

namespace Adagio\Mlt;

class Producer extends Service
{
    /**
     * 
     * @return int
     */
    public function getPlaytime()
    {
        return Producer_get_playtime($this->_cPtr);
    }

    /**
     * Producer frame position
     * 
     * @return int
     */
    public function getPosition()
    {
        return producer_position($this->_cPtr);
    }

    /**
     * Producer speed
     *
     * @return float
     */
    public function getSpeed()
    {
        return producer_get_speed($this->_cPtr);
    }

    /**
     * Output frames per second
     *
     * @return float
     */
    public function getFPS()
    {
        return producer_get_fps($this->_cPtr);
    }

    /**
     * The in point in frames
     *
     * @return int
     */
    public function getIn()
    {
       return producer_get_in($this->_cPtr); 
    }

    /**
     * Set the in point in frames
     *
     * @param int $frame
     * @return boolean
     */
    public function setIn($frame)
    {
        return $this->setProperty('in', $frame);
    }

    /**
     * The out point in frames
     *
     * @return int
     */
    public function getOut()
    {
       return producer_get_out($this->_cPtr); 
    }

    /**
     * Set the out point in frames
     *
     * @param int $frame
     * @return boolean
     */
    public function setOut($frame)
    {
        return $this->setProperty('out', $frame);
    }

    /**
     * The length of the input in frames
     *
     * @return int
     */
    public function getLength()
    {
        return producer_get_length($this->_cPtr);
    }

    public function test()
    {
        $count = properties_count($p = $this->getPropertiesResource());
        for ($n = 0 ; $n < $count ; $n++) {
            echo properties_get_name($p, $n).' -> '.properties_get($p, $n)."\n";
            
        }
    }
    public function onChange($callable)
    {
$p = new_Properties($this->_cPtr);
$bar = Properties_setup_wait_for($p,'producer-changed');
var_dump($bar);
$pouet = new \SWIGTYPE_p_mlt_listener();
		if (is_resource($bar)) {
			$c=substr(get_resource_type($bar), (strpos(get_resource_type($bar), '__') ? strpos(get_resource_type($bar), '__') + 2 : 3));
var_dump($c);
//			if (class_exists($c)) return new $c($bar);
//			return new Event($bar);
		}
$r=Properties_listen($p,'producer-changed',$this->_cPtr, $pouet);
var_dump($r);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
var_dump($c);
			if (class_exists($c)) return new $c($r);
			return new Event($r);
		}
		return $r;
        
    }
}