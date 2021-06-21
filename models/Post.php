<?php
class Post 
{
    public  $id;
    public  $postDate;
    public  $content;

    
   

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): Post
    {
        $this->id = $id;
        return $this;
    }

    public function getPostDate()
    {
        return $this->postDate;
    }

    public function setPostDate($postDate): Post
    {
        $this->postdate = $postDate;
        return $this;
    }


    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent($content): Post
    {
        $this->content = $content;
        return $this;
    }


}