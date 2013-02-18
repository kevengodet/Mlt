<?php

namespace Adagio\Mlt;

//<!ELEMENT tractor (multitrack, (filter | transition)*) >
//<!ATTLIST tractor
//    id       ID       #IMPLIED
//    in       CDATA    #IMPLIED
//    out      CDATA    #IMPLIED
//>
class Tractor
{
    private $id; //       ID       #IMPLIED
    private $in; //       CDATA    #IMPLIED
    private $out; //      CDATA    #IMPLIED

    /**
     *
     * @var Multitrack
     */
    private $multitrack;

    /**
     *
     * @var array of Filter
     */
    private $filters = array();

    /**
     *
     * @var array of Transition
     */
    private $transitions = array();

    /**
     * 
     * @param Multitrack $multitrack
     */
    public function setMultitrack(Multitrack $multitrack)
    {
        $this->multitrack = $multitrack;
    }

    /**
     * 
     * @return Multitrack
     */
    public function getMultitrack()
    {
        return $this->multitrack;
    }

    /**
     * 
     * @param array $filters
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
    }

    /**
     * 
     * @return array of Filter
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * 
     * @param Filter $filter
     */
    public function addFilter(Filter $filter)
    {
        $this->filters[] = $filter;
    }

    /**
     * 
        * @param array $transitions
     */
    public function setTransitions($transitions)
    {
        $this->transitions = $transitions;
    }

    /**
     * 
     * @return array of Transition
     */
    public function getTransitions()
    {
        return $this->transitions;
    }

    /**
     * 
     * @param Transition $transition
     */
    public function addTransition(Transition $transition)
    {
        $this->transition[] = $transition;
    }
}