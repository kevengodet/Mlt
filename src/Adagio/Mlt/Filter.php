<?php

namespace Adagio\Mlt;

use Adagio\Mlt\Common\PropertyTrait;

//<!ELEMENT filter (property)* >
//<!ATTLIST filter
//    id       ID       #IMPLIED
//    in       CDATA    #IMPLIED
//    out      CDATA    #IMPLIED
//    mlt_service  CDATA    #IMPLIED
//    track    CDATA    #IMPLIED
//>
class Filter implements Service
{
    use PropertyTrait;

    private $id; //       ID       #IMPLIED

    /**
     *
     * @var float
     */
    private $in; //       CDATA    #IMPLIED

    /**
     *
     * @var float
     */
    private $out; //      CDATA    #IMPLIED

    /**
     *
     * @var Track
     */
    private $track; //    CDATA    #IMPLIED

    /**
     *
     * @var string
     */
    private $mltService; //  CDATA    #IMPLIED

    /**
     * 
     * @param float $in
     */
    public function setIn($in)
    {
        $this->in = $in;
    }

    /**
     * 
     * @return float
     */
    public function getIn()
    {
        return $this->in;
    }

    /**
     * 
     * @param float $out
     */
    public function setOut($out)
    {
        $this->out = $out;
    }

    /**
     * 
     * @return float
     */
    public function getOut()
    {
        return $this->out;
    }

    /**
     * 
     * @param string $service
     */
    public function setMltService($service)
    {
        $this->mltService = $service;
    }

    /**
     * 
     * @return string
     */
    public function getMltService()
    {
        return $this->mltService;
    }

    /**
     * 
     * @param Track $track
     */
    public function setTrack(Track $track)
    {
        $this->track = $track;
    }

    /**
     * 
     * @return Track
     */
    public function getTrack()
    {
        return $this->track;
    }
}