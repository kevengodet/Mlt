<?php

namespace Adagio\Mlt;

//<!ELEMENT track (producer | playlist | tractor | multitrack | filter | transition)* >
//<!ATTLIST track
//    producer IDREF    #IMPLIED
//>
class Track
{
    /**
     *
     * @var Producer
     */
    private $producer; // IDREF    #IMPLIED

    /**
     * 
     * @param Producer $producer
     */
    public function setProducer(Producer $producer)
    {
        $this->producer = $producer;
    }

    /**
     * 
     * @return Producer
     */
    public function getProducer()
    {
        return $this->producer;
    }
}