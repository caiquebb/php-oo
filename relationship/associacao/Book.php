<?php

class Book
{
    private $title;
    private $isbn;
    private $publishing;

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get the value of isbn
     */ 
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set the value of isbn
     *
     * @return  self
     */ 
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * Get the value of publishing
     */ 
    public function getPublishing()
    {
        return $this->publishing;
    }

    /**
     * Set the value of publishing
     *
     * @return  self
     */ 
    public function setPublishing($publishing)
    {
        $this->publishing = $publishing;
    }
}