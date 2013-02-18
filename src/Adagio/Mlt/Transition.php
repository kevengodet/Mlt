<?php

namespace Adagio\Mlt;

use Adagio\Mlt\Common\PropertyTrait;

//<!ELEMENT transition (property)* >
//<!ATTLIST transition
//    id       ID       #IMPLIED
//    in       CDATA    #IMPLIED
//    out      CDATA    #IMPLIED
//    mlt_service  CDATA    #IMPLIED
//    a_track  CDATA    #IMPLIED
//    b_track  CDATA    #IMPLIED
//>
class Transition implements Service
{
    use PropertyTrait;

    private $id; //       ID       #IMPLIED
    private $in; //       CDATA    #IMPLIED
    private $out; //      CDATA    #IMPLIED
    private $a_track; //  CDATA    #IMPLIED
    private $b_track; //  CDATA    #IMPLIED

    /**
     *
     * @var string
     */
    private $mltService; //  CDATA    #IMPLIED

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
}