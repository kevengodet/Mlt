<?php

namespace Adagio\Mlt;

class Profile extends Service
{
    /**
     * 
     * @return string
     */
    function getDescription()
    {
        return Profile_description($this->_cPtr);
    }

}