<?php 

namespace model;

class Usuario {
    private ?int $id;
    private ?string $user; 
    private ?string $password;
    private ?string $email; 


    public function getId(){
        return $id;
    }
    public function getUser(){
        return $user;
    }
    public function getPassword(){
        return $password;
    }
    public function getEmail(){
        return $email;
    }

    public function setId(int $id){
        $this->id = $id; 
    }
    public function setUser(int $user){
        $this->user = $user; 
    }
    public function setPassword(int $password){
        $this->password = $password; 
    }
    public function setEmail(int $email){
        $this->email = $email; 
    }
}

?>