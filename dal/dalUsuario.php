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

    public function Login(\model\Usuario $usuario) {
        $con = \dal\Conexao::conectar();
        $p_Username = $usuario->getUser();
        $p_Password = $usuario->getPassword();
        
        $sql = "CALL Login(:username, :password, @p_Token, @p_UserId, @p_STATUS_CODE, @p_MESSAGE);";

        $stmt = $con->prepare($sql);

        $stmt->bindParam(':username', $p_Username);
        $stmt->bindParam(':password', $p_Password);

        $stmt->execute();

        $result = $con->query("SELECT @p_Token, @p_UserId, @p_STATUS_CODE, @p_MESSAGE");
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        $status_code = $row['@p_STATUS_CODE'];
        $message = $row['@p_MESSAGE'];
        $teste = "";
        session_start();
        if($status_code == 200){
            $token = bin2hex($row['@p_Token']);
            $_SESSION['Token'] = $token;
            $_SESSION['UserId'] = $row['@p_UserId'];
            $teste = $_SESSION['Token'];
        };

        \dal\Conexao::desconectar();

        return array('STATUS_CODE' => $status_code, 'MESSAGE' => $message, 'ENTROU' => $teste);
    }
    public function SelectUser() {
        //session_start();
        $sql = "SELECT Username FROM mpguser WHERE UserId = ". $_SESSION['UserId'] .";";
        $con = Conexao::conectar();
        $stmt = $con->query($sql);
        $linha = $stmt->fetch(\PDO::FETCH_ASSOC);
        Conexao::desconectar($con);
    
        return $linha['Username'];
    }
}

?>