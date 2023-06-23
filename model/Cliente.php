<?php 

namespace model;

class Cliente {
    private ?int $id;
    private ?string $CPF_CNPJ;
    private ?string $Nome;
    private ?string $RG_IE;
    private ?string $Tipo_pessoa;
    private ?string $Data_nascimento ;
    private ?string $Sexo;

    public function getId(){
        return $this->id;
    }
    public function getNome(){
        return $this->Nome;
    }
    public function getCPF_CNPJ(){
        return $this->CPF_CNPJ;
    }
    public function getRG_IE(){
        return $this->RG_IE;
    }
    public function getTipo_pessoa(){
        return $this->Tipo_pessoa;
    }
    public function getData_nascimento(){
        return $this->Data_nascimento;
    }
    public function getSexo(){
        return $this->Sexo;
    }

    public function setId(int $id){
        $this->id = $id; 
    }
    public function setNome(string $Nome){
        $this->Nome = $Nome; 
    }
    public function setCPF_CNPJ(string $CPF_CNPJ){
        $this->CPF_CNPJ = $CPF_CNPJ; 
    }
    public function setRG_IE(string $RG_IE){
        $this->RG_IE = $RG_IE; 
    }
    public function setTipo_pessoa(string $Tipo_pessoa){
        $this->Tipo_pessoa = $Tipo_pessoa; 
    }
    public function setData_nascimento(string $Data_nascimento){
        $this->Data_nascimento = $Data_nascimento; 
    }
    public function setSexo(string $Sexo){
        $this->Sexo = $Sexo; 
    }

}

?>