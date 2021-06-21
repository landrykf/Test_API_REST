<?php


class Topic
{
    public  $id;
    public  $title;
    
   

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): Topic
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Topic
    {
        $this->title = $title;
        return $this;
    }
}