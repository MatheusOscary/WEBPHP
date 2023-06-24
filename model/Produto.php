<?php 

namespace model;

class Produto {
    private ?int $id;
    private ?string $Nome; 
    private ?float $Preco_venda;
    private ?float $Preco_compra;
    private ?string $Cod_barra; 
    private ?float $Estoque;


    public function getId(){
        return $this->id;
    }
    public function getNome(){
        return $this->Nome;
    }
    public function getPreco_venda(){
        return $this->Preco_venda;
    }
    public function getPreco_compra(){
        return $this->Preco_compra;
    }
    public function getCod_barra(){
        return $this->Cod_barra;
    }
    public function getEstoque(){
        return $this->Estoque;
    }

    public function setId(int $id){
        $this->id = $id; 
    }
    public function setNome(string $Nome){
        $this->Nome = $Nome; 
    }
    public function setPreco_venda(float $Preco_venda){
        $this->Preco_venda = $Preco_venda; 
    }
    public function setPreco_compra(float $Preco_compra){
        $this->Preco_compra = $Preco_compra; 
    }
    public function setCod_barra(string $Cod_barra){
        $this->Cod_barra = $Cod_barra; 
    }
    public function setEstoque(float $Estoque){
        $this->Estoque = $Estoque; 
    }
}

?>