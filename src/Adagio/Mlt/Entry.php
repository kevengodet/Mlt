<?php

namespace Adagio\Mlt;

//<!ELEMENT entry (producer | playlist | tractor | multitrack | filter | transition)* >
//<!ATTLIST entry
//    producer IDREF    #IMPLIED
//    in       CDATA    #IMPLIED
//    out      CDATA    #IMPLIED
//>
class Entry
{
    /**
     *
     * @var Producer
     */
    private $producer; // IDREF    #IMPLIED

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
     * @var array of Playlist
     */
    private $playlists = array();

    /**
     *
     * @var array of Tractor
     */
    private $tractors = array();

    /**
     *
     * @var array of Multitrack
     */
    private $multitracks = array();

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

    /**
     * 
     * @param array $playlists
     */
    public function setPlaylists($playlists)
    {
        $this->playlists = $playlists;
    }

    /**
     * 
     * @return array of Playlist
     */
    public function getPlaylists()
    {
        return $this->playlists;
    }

    /**
     * 
     * @param Producer $producer
     */
    public function addPlaylist(Playlist $playlist)
    {
        $this->playlists[] = $playlist;
    }

    /**
     * 
     * @param array $tractors
     */
    public function setTractors($tractors)
    {
        $this->tractors = $tractors;
    }

    /**
     * 
     * @return array of Tractor
     */
    public function getTractors()
    {
        return $this->tractors;
    }

    /**
     * 
     * @param Tractor $tractor
     */
    public function addTractor(Tractor $tractor)
    {
        $this->tractors[] = $tractor;
    }

    /**
     * 
     * @param array $multitracks
     */
    public function setMultitracks($multitracks)
    {
        $this->multitracks = $multitracks;
    }

    /**
     * 
     * @return array of Multitrack
     */
    public function getMultitracks()
    {
        return $this->multitracks;
    }

    /**
     * 
     * @param Multitrack $multitrack
     */
    public function addMultitrack(Multitrack $multitrack)
    {
        $this->multitracks[] = $multitrack;
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
        $this->transitions = $transition;
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
        $this->transitions[] = $transition;
    }
}