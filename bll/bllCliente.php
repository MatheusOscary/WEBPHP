<?php 

namespace bll;
use dal\dalCliente;

include_once "../../dal/dalCliente.php";

class bllCliente{
    public function Insert(\model\Cliente $cliente){
        $dal = new \dal\dalCliente;
        $result = array();
        $result = $dal->Insert($cliente);
        return $result;
    }

    public function Update(\model\Cliente $cliente){
        $dal = new \dal\dalCliente;
        $result = $dal->Update($cliente);
        return $result;
    }

    public function Select(){
        $dal = new \dal\dalCliente;
        $result[] = $dal->Select();
        return $result;
    }
}

?>