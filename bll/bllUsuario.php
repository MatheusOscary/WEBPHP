<?php 

namespace bll;
use dal\dalUsuario;

include_once "../../dal/dalUsuario.php";

class bllUsuario{
    public function Insert(\model\Usuario $usuario){
        $dal = new \dal\dalUsuario;
        $dal->Insert($usuario);
    }
}

?>