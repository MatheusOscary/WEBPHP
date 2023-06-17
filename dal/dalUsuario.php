<?php 

namespace dal;

include_once "conection.php";
include_once "../../model/Usuario.php";

class dalUsuario{
    public function Insert(\model\Usuario $usuario) {
        $con = \dal\Conexao::conectar();

        $p_Username = $usuario->getUser();
        $p_Password = $usuario->getPassword();
        $p_Email = $usuario->getEmail();

        $sql = "CALL InsertUser(:username, :password, :email, @p_STATUS_CODE, @p_MESSAGE);";

        $stmt = $con->prepare($sql);

        $stmt->bindParam(':username', $p_Username);
        $stmt->bindParam(':password', $p_Password);
        $stmt->bindParam(':email', $p_Email);

        $stmt->execute();

        $result = $con->query("SELECT @p_STATUS_CODE, @p_MESSAGE");
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        $status_code = $row['@p_STATUS_CODE'];
        $message = $row['@p_MESSAGE'];

        \dal\Conexao::desconectar();

        return array('STATUS_CODE' => $status_code, 'MESSAGE' => $message);
    }
}

?>