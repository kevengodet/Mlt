<?php

namespace Adagio\Mlt;

//<!ELEMENT blank EMPTY >
//<!ATTLIST blank
//    length   CDATA    #REQUIRED
//>
class Blank
{
    /**
     *
     * @var float
     */
    private $length; //   CDATA    #REQUIRED

    /**
     * 
     * @param float $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * 
     * @return float
     */
    public function getLength()
    {
        return $this->length;
    }
}