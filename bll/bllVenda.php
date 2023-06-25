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

}

?>