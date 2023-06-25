<?php 

namespace dal;

include_once "conection.php";
include_once "../../model/Cliente.php";
class dalCliente{
    public function Insert(\model\Cliente $cliente) {
        $con = \dal\Conexao::conectar();

        $CPF_CNPJ = $cliente->getCPF_CNPJ();
        $Nome = $cliente->getNome();
        $RG_IE = $cliente->getRG_IE();
        $Tipo_pessoa = $cliente->getTipo_pessoa();
        $Data_nascimento = $cliente->getData_nascimento();
        $Sexo = $cliente->getSexo();

        $sql = "CALL InsertConsumer(:Nome, :CPF_CNPJ, :RG_IE, :Tipo_pessoa, :Data_nascimento, :Sexo, :Insert_session, :UserId, @p_STATUS_CODE, @p_MESSAGE);";
        
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':CPF_CNPJ',$CPF_CNPJ);
        $stmt->bindParam(':Nome',$Nome);
        $stmt->bindParam(':RG_IE',$RG_IE);
        $stmt->bindParam(':Tipo_pessoa',$Tipo_pessoa);
        $stmt->bindParam(':Data_nascimento',$Data_nascimento);
        $stmt->bindParam(':Sexo',$Sexo);

        $token = HEX2BIN($_SESSION["Token"]);
        $stmt->bindParam(':Insert_session', $token);
        $stmt->bindParam(':UserId', $_SESSION['UserId']);

        $stmt->execute();

        $stmt->closeCursor();

        $result = $con->query("SELECT @p_STATUS_CODE, @p_MESSAGE");
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        $status_code = $row['@p_STATUS_CODE'];
        $message = $row['@p_MESSAGE'];

        \dal\Conexao::desconectar();

        return array('STATUS_CODE' => $status_code, 'MESSAGE' => $message);
    }

    public function Update(\model\Cliente $cliente) {
        $con = \dal\Conexao::conectar();
        
        $id = $cliente->getId();
        $RG_IE = $cliente->getRG_IE();
        $Nome = $cliente->getNome();
        $Tipo_pessoa = $cliente->getTipo_pessoa();
        $Data_nascimento = $cliente->getData_nascimento();
        $Sexo = $cliente->getSexo();
        $token = HEX2BIN($_SESSION["Token"]);

        $sql = "UPDATE mpgConsumer SET Update_date=NOW(), Update_session='". $token ."' , Nome='". $Nome ."', RG_IE = '". $RG_IE ."', Tipo_pessoa = '". $Tipo_pessoa ."', Data_nascimento = '". $Data_nascimento ."', Sexo = '". $Sexo ."' WHERE ConsumerId = ". $id .";";

        $stmt = $con->prepare($sql);
        $result = $stmt->execute();

        \dal\Conexao::desconectar();

        return  $result; 
    }

    public function Select() {
        $sql = "SELECT Nome, ConsumerId, CPF_CNPJ, RG_IE, Tipo_pessoa, Data_nascimento, Sexo FROM mpgConsumer WHERE UserId = ". $_SESSION['UserId'] .";";
        $con = Conexao::conectar(); 
        $result = $con->query($sql); 
        $con = Conexao::desconectar();
        $lstCliente = [];
        foreach ($result as $linha){
            $cliente = new \MODEL\Cliente(); 
            
            $cliente->setNome($linha['Nome']); 
            $cliente->setId($linha['ConsumerId']); 
            $cliente->setCPF_CNPJ($linha['CPF_CNPJ']); 
            $cliente->setRG_IE($linha['RG_IE']);
            $cliente->setTipo_pessoa($linha['Tipo_pessoa']); 
            $cliente->setSexo($linha['Sexo']); 
            $data = date_create($linha['Data_nascimento']);
            $cliente->setData_nascimento(date_format($data, 'd-m-Y')); 

            $lstCliente[] = $cliente; 
        }
        
        return $lstCliente; 
    }

    public function SelectConsumer($ConsumerId) {
        $sql = "SELECT Nome, ConsumerId, CPF_CNPJ, RG_IE, Tipo_pessoa, Data_nascimento, Sexo FROM mpgConsumer WHERE UserId = ".$_SESSION['UserId']." AND ConsumerId = ".$ConsumerId.";";
        $con = Conexao::conectar();
        $stmt = $con->query($sql);
        $linha = $stmt->fetch(\PDO::FETCH_ASSOC);
        Conexao::desconectar($con);
    
        $cliente = new \MODEL\Cliente();
        
        $cliente->setNome($linha['Nome']); 
        $cliente->setId($linha['ConsumerId']);
        $cliente->setCPF_CNPJ($linha['CPF_CNPJ']);
        $cliente->setRG_IE($linha['RG_IE']);
        $cliente->setTipo_pessoa($linha['Tipo_pessoa']);
        $cliente->setSexo($linha['Sexo']);
        $data = date_create($linha['Data_nascimento']);
        $cliente->setData_nascimento(date_format($data, 'd-m-Y'));
    
        return $cliente;
    }

    public function Delete($ConsumerId){
        $con = \dal\Conexao::conectar();

        $sql = "DELETE FROM mpgconsumer WHERE ConsumerId=". $ConsumerId .";";

        $stmt = $con->prepare($sql);
        $result = $stmt->execute();

        \dal\Conexao::desconectar();

        return  $result; 
    }
}

?>