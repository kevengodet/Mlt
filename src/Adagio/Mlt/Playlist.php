<?php

namespace Adagio\Mlt;

//<!ELEMENT playlist (entry | blank | producer | playlist | tractor | multitrack)+ >
//<!ATTLIST playlist
//    id       ID       #IMPLIED
//    in       CDATA    #IMPLIED
//    out      CDATA    #IMPLIED
//>
class Playlist
{
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
     * @var array of Entry
     */
    private $entries = array();

    /**
     *
     * @var array of Blank
     */
    private $blanks = array();

    /**
     *
     * @var array of Producer
     */
    private $producers = array();

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
     * @param array $entries
     */
    public function setEntries($entries)
    {
        $this->entries = $entries;
    }

    /**
     * 
     * @return array of Entry
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * 
     * @param Entry $entry
     */
    public function addEntry($entry)
    {
        $this->$entrie[] = $entry;
    }

    /**
     * 
     * @param array $blanks
     */
    public function setBlanks($blanks)
    {
        $this->blanks = $blanks;
    }

    /**
     * 
     * @return array of Producer
     */
    public function getBlanks()
    {
        return $this->blanks;
    }

    /**
     * 
     * @param Blank $blank
     */
    public function addBlank($blank)
    {
        $this->blanks[] = $blank;
    }

    /**
     * 
     * @param array $producers
     */
    public function setProducers($producers)
    {
        $this->producers = $producers;
    }

    /**
     * 
     * @return array of Producer
     */
    public function getProducers()
    {
        return $this->producers;
    }

    /**
     * 
     * @param Producer $producer
     */
    public function addProducer($producer)
    {
        $this->producers[] = $producer;
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
}