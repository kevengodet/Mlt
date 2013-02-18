<?php

namespace Adagio\Mlt;

//<!ELEMENT mlt (profile | producer | playlist | tractor | multitrack | consumer)+ >
//<!ATTLIST mlt
//    LC_NUMERIC CDATA    #IMPLIED
//    version    CDATA    #IMPLIED
//    root       CDATA    #IMPLIED
//    profile    CDATA    #IMPLIED
//    title      CDATA    #IMPLIED
//>
class Project
{
    private $LC_NUMERIC; // CDATA    #IMPLIED
    private $version; //    CDATA    #IMPLIED
    private $root; //       CDATA    #IMPLIED
    private $profile; //    CDATA    #IMPLIED
    private $title; //      CDATA    #IMPLIED

    /**
     *
     * @var array of Profile
     */
    private $profiles = array();

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
     * @param array $profiles
     */
    public function setProfiles($profiles)
    {
        $this->profiles = $profiles;
    }

    /**
     * 
     * @return array of Profile
     */
    public function getProfiles()
    {
        return $this->profiles;
    }

    /**
     * 
     * @param Profile $profile
     */
    public function addProfile(Profile $profile)
    {
        $this->profiles[] = $profile;
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
    public function addProducer(Producer $producer)
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
}