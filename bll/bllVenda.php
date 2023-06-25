<?php 

namespace bll;
use dal\dalVenda;

include_once "../../dal/dalVenda.php";

class bllVenda{
    public function InsertSold(){
        $dal = new \dal\dalVenda;
        $result = $dal->InsertSold();
        header("location: venda.php?SoldId=". $result .""); 
        return $result;
    }
    public function InsertProductSold(\model\VendaProduto $vendaProduto){
        $dal = new \dal\dalVenda;
        $result = array();
        $result = $dal->InsertProductSold($vendaProduto);
        return $result;
    }
    public function SelectProductSold($SoldId){
        $dal = new \dal\dalVenda;
        $result = $dal->SelectProductSold($SoldId);
        return $result;
    }
    public function DeleteProductSold(\model\VendaProduto $vendaProduto){
        $dal = new \dal\dalVenda;
        $result = array();
        $result = $dal->DeleteProductSold($vendaProduto);
        return $result;
    }
    public function InsertConsumerSold($SoldId, $CPF_CNPJ){
        $dal = new \dal\dalVenda;
        $result = array();
        $result = $dal->InsertConsumerSold($SoldId, $CPF_CNPJ);
        return $result;
    }
    public function SelectSold($SoldId){
        $dal = new \dal\dalVenda;
        $result = $dal->SelectSold($SoldId);
        return $result;
    }
    public function FinalizeSold($SoldId, $Forma_pagto){
        $dal = new \dal\dalVenda;
        $result = $dal->FinalizeSold($SoldId, $Forma_pagto);
        return $result;
    }
    public function SelectSoldC(){
        $dal = new \dal\dalVenda;
        $result = $dal->SelectSoldC();
        return $result;
    }
    public function SelectSoldA(){
        $dal = new \dal\dalVenda;
        $result = $dal->SelectSoldA();
        return $result;
    }
}

?>