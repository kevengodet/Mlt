<?php

namespace Adagio\Mlt;

//<!ELEMENT multitrack (track | producer | playlist | tractor | multitrack)+ >
//<!ATTLIST multitrack
//    id       ID       #IMPLIED
//>
class Multitrack
{
    private $id; //       ID       #IMPLIED

    /**
     *
     * @var array of Track
     */
    private $tracks = array();

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
     * @param array $tracks
     */
    public function setTracks($tracks)
    {
        $this->tracks = $tracks;
    }

    /**
     * 
     * @return array of Track
     */
    public function getTracks()
    {
        return $this->tracks;
    }

    /**
     * 
     * @param Track $track
     */
    public function addTracks($track)
    {
        $this->tracks[] = $track;
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
    public function addProducers($producer)
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