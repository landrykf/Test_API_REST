<?php
class User {
  

    public $id;
    public $email;
    public $password;
    public $birthDate;
 


    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): User
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->title;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }
    

    public function getPassword(): string
    {
        return $this->title;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }
    

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate): User
    {
        $this->birthDate = $birthDate;
        return $this;
    }
    
}