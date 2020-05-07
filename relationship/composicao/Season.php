<?php

class Season
{
    private $episode;

    public function __construct()
    {
        $this->episode = new Episode;
    }

    public function setEpisode($title, $description)
    {
        $this->episode->setTitle($title);
        $this->episode->setDescription($description);
    }

    public function getEpisode()
    {
        return $this->episode;
    }
}
