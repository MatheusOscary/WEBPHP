<?php 

namespace bll;
use dal\dalProduto;

include_once "../../dal/dalProduto.php";

class bllProduto{
    public function Insert(\model\Produto $produto){
        $dal = new \dal\dalProduto;
        $result = array();
        $result = $dal->Insert($produto);
        return $result;
    }

    public function Update(\model\Produto $produto){
        $dal = new \dal\dalProduto;
        $result = $dal->Update($produto);
        return $result;
    }

    public function Select(){
        $dal = new \dal\dalProduto;
        $result = $dal->Select();
        return $result;
    }

    public function SelectConsumer($produto){
        $dal = new \dal\dalProduto;
        $result = $dal->SelectConsumer($produto);
        return $result;
    }

    public function Delete($produto){
        $dal = new \dal\dalProduto;
        $result = $dal->Delete($produto);
        return $result;
    }
}

?>