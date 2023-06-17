<?php 

namespace dal;

include_once "conection.php"
include_once "../model/Usuario.php"

class dalUsuario{
    public function Insert(\model\Usuario $usuario) {
        $con = Conexao::conectar();
    
        $p_Username = $usuario->getUser();
        $p_Password = $usuario->getPassword();
        $p_Email = $usuario->getEmail();
        
        $sql = "CALL InsertUser('$p_Username', '$p_Password', '$p_Email', @p_STATUS_CODE, @p_MESSAGE); SELECT @p_STATUS_CODE, @p_MESSAGE;";
        
        $result = $con->multi_query($sql);
        
        if (!$result) {
            die("Erro na execução da query: " . $con->error);
        }
        
        $con->next_result();
        $result = $con->store_result();
        
        $row = $result->fetch_assoc();
        $status_code = $row['@p_STATUS_CODE'];
        $message = $row['@p_MESSAGE'];
        
        Conexao::desconectar($con);
        
        return array('STATUS_CODE' => $status_code, 'MESSAGE' => $message);
    }
}

?>