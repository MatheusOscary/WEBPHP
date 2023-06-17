<?php 

namespace model;

class Usuario {
    private ?int $id;
    private ?string $user; 
    private ?string $password;
    private ?string $email; 


    public function getId(){
        return $this->id;
    }
    public function getUser(){
        return $this->user;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getEmail(){
        return $this->email;
    }

    public function setId(int $id){
        $this->id = $id; 
    }
    public function setUser(string $user){
        $this->user = $user; 
    }
    public function setPassword(string $password){
        $this->password = $password; 
    }
    public function setEmail(string $email){
        $this->email = $email; 
    }
}

?>