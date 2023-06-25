<?php 

namespace model;

class Venda {
    private ?int    $id;
    private ?float  $Total;
    private ?string $Estado;
    private ?string $Consumer;
    private ?string    $Forma_pagto;

    public function getId(){
        return $this->id;
    }
    public function getConsumer(){
        return $this->Consumer;
    }
    public function getTotal(){
        return $this->Total;
    }
    public function getEstado(){
        return $this->Estado;
    }
    public function getForma_pagto(){
        return $this->Forma_pagto;
    }

    public function setid(int $id){
        $this->id = $id;
    }
    public function setTotal(float $Total){
        $this->Total = $Total;
    }
    public function setEstado(string $Estado){
        $this->Estado = $Estado;
    }
    public function setConsumer(string $Consumer){
        $this->Consumer = $Consumer;
    }
    public function setForma_pagto(string $Forma_pagto){
        $this->Forma_pagto = $Forma_pagto;
    }
    
}


class VendaProduto {
    private ?int    $id;
    private ?string $Cod_barra;
    private ?int    $SoldId;
    private ?float  $Preco;
    private ?string $Nome;
    private ?float  $Quantidade;


    public function getId(){
        return $this->id;
    }
    public function getCod_barra(){
        return $this->Cod_barra;
    }
    public function getSoldId(){
        return $this->SoldId;
    }
    public function getNome(){
        return $this->Nome;
    }
    public function getPreco(){
        return $this->Preco;
    }
    public function getQuantidade(){
        return $this->Quantidade;
    }

    public function setid(int $id){
        $this->id = $id;
    }
    public function setCod_barra(string $Cod_barra){
        $this->Cod_barra = $Cod_barra;
    }
    public function setNome(string $Nome){
        $this->Nome = $Nome;
    }
    public function setSoldId(int $SoldId){
        $this->SoldId = $SoldId;
    }
    public function setPreco(float $Preco){
        $this->Preco = $Preco;
    }
    public function setQuantidade(float $Quantidade){
        $this->Quantidade = $Quantidade;
    }
}

?>