<?php 

namespace dal;

include_once "conection.php";
include_once "../../model/Venda.php";

class dalVenda{
    public function InsertSold() {
        session_start();
        $con = \dal\Conexao::conectar();

        $sql = "CALL InsertSold(:Insert_session, :UserId, @p_STATUS_CODE, @p_MESSAGE, @p_SoldId);";
        
        $stmt = $con->prepare($sql);
        $token = HEX2BIN($_SESSION["Token"]);
        $stmt->bindParam(':Insert_session', $token);
        $stmt->bindParam(':UserId', $_SESSION['UserId']);

        $stmt->execute();

        $stmt->closeCursor();

        $result = $con->query("SELECT @p_SoldId");
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        $SoldId = $row['@p_SoldId'];

        \dal\Conexao::desconectar();

        return $SoldId;
    }
    public function InsertProductSold(\model\VendaProduto $vendaProduto) {
        session_start();
        $con = \dal\Conexao::conectar();

        $Cod_barra=$vendaProduto->getCod_barra();
        $SoldId=$vendaProduto->getSoldId();
        $Quantidade=$vendaProduto->getQuantidade();

        $sql = "CALL InsertProductSold (:Cod_barra, :SoldId, :Quantidade, :Insert_session, :UserId, @p_STATUS_CODE, @p_MESSAGE)";
        

        $stmt = $con->prepare($sql);

        $stmt->bindParam(':Cod_barra',$Cod_barra);
        $stmt->bindParam(':SoldId',$SoldId);
        $stmt->bindParam(':Quantidade',$Quantidade);
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
    public function SelectProductSold($SoldId) {
        $sql = "SELECT mpgproducts.ProductsId, mpgproducts.Cod_barra, mpgproducts.Nome, mpgproductsold.Quantidade, mpgproductsold.Preco FROM mpgproductsold INNER JOIN mpgproducts ON mpgproductsold.ProductsId = mpgproducts.ProductsId WHERE mpgproductsold.SoldId = ". $SoldId .";";
        $con = Conexao::conectar();
        $stmt = $con->query($sql);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        Conexao::desconectar($con);
        
        $lstvendaProduto = [];
        foreach ($result as $linha){
            $vendaProduto = new \MODEL\VendaProduto(); 
            
            $vendaProduto->setid($linha['ProductsId']);
            $vendaProduto->setCod_barra($linha['Cod_barra']);
            $vendaProduto->setNome($linha['Nome']);
            $vendaProduto->setPreco($linha['Preco']);
            $vendaProduto->setQuantidade($linha['Quantidade']);

            $lstvendaProduto[] = $vendaProduto; 
        }
        
        return $lstvendaProduto; 
    }

    public function DeleteProductSold(\model\VendaProduto $vendaProduto) {
        session_start();
        $con = \dal\Conexao::conectar();

        $ProductsId=$vendaProduto->getId();
        $SoldId=$vendaProduto->getSoldId();

        $sql = "CALL DeleteProductSold(:ProductsId, :SoldId, :Deleted_session, @p_STATUS_CODE, @p_MESSAGE)";
    

        $stmt = $con->prepare($sql);

        $stmt->bindParam(':ProductsId',$ProductsId);
        $stmt->bindParam(':SoldId',$SoldId);
        $token = HEX2BIN($_SESSION["Token"]);
        $stmt->bindParam(':Deleted_session', $token);

        $stmt->execute();

        $stmt->closeCursor();
        $result = $con->query("SELECT @p_STATUS_CODE, @p_MESSAGE");
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        $status_code = $row['@p_STATUS_CODE'];
        $message = $row['@p_MESSAGE'];

        \dal\Conexao::desconectar();

        return array('STATUS_CODE' => $status_code, 'MESSAGE' => $message);
    }

    public function InsertConsumerSold($SoldId, $CPF_CNPJ) {
        session_start();
        $con = \dal\Conexao::conectar();


        $sql = "CALL InsertConsumerSold(:CPF_CNPJ, :SoldId, :Insert_session, @p_STATUS_CODE, @p_MESSAGE)";
    

        $stmt = $con->prepare($sql);

        $stmt->bindParam(':CPF_CNPJ',$CPF_CNPJ);
        $stmt->bindParam(':SoldId',$SoldId);
        $token = HEX2BIN($_SESSION["Token"]);
        $stmt->bindParam(':Insert_session', $token);

        $stmt->execute();

        $stmt->closeCursor();
        $result = $con->query("SELECT @p_STATUS_CODE, @p_MESSAGE");
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        $status_code = $row['@p_STATUS_CODE'];
        $message = $row['@p_MESSAGE'];

        \dal\Conexao::desconectar();

        return array('STATUS_CODE' => $status_code, 'MESSAGE' => $message);
    }
    public function SelectSold($SoldId) {
        $sql = "SELECT mpgsold.SoldId, mpgsold.Total, mpgsold.Estado, mpgsold.Forma_pagto, mpgconsumer.Nome  FROM mpgsold INNER JOIN mpgconsumer ON mpgsold.ConsumerId = mpgconsumer.ConsumerId WHERE mpgsold.SoldId = ". $SoldId ." AND mpgsold.Estado = 'A';";
        $con = Conexao::conectar();
        $stmt = $con->query($sql);
        $linha = $stmt->fetch(\PDO::FETCH_ASSOC);
        Conexao::desconectar($con);
    
        $venda = new \MODEL\Venda();
        
        $venda->setId($linha['SoldId']);
        $venda->setTotal($linha['Total']);
        $venda->setEstado($linha['Estado']);
        $venda->setConsumer($linha['Nome']);
        $venda->setForma_pagto($linha['Forma_pagto']);
    
        return $venda;
    }

    public function FinalizeSold($SoldId, $Forma_pagto) {
        session_start();
        $con = \dal\Conexao::conectar();


        $sql = "CALL FinalizeSold(:SoldId, :Forma_pagto, :Insert_session)";
    

        $stmt = $con->prepare($sql);

        $stmt->bindParam(':SoldId',$SoldId);
        $stmt->bindParam(':Forma_pagto',$Forma_pagto);
        $token = HEX2BIN($_SESSION["Token"]);
        $stmt->bindParam(':Insert_session', $token);

        $result = $stmt->execute();

        $stmt->closeCursor();

        \dal\Conexao::desconectar();

        return  $result;
    }
    public function SelectSoldC() {
        $sql = "SELECT mpgsold.SoldId, mpgsold.Total, mpgsold.Estado, IF(mpgsold.Forma_pagto = 1, 'Pix', 'Dinheiro') AS Forma_pagto, mpgconsumer.Nome  FROM mpgsold INNER JOIN mpgconsumer ON mpgsold.ConsumerId = mpgconsumer.ConsumerId WHERE mpgsold.Estado = 'C' AND mpgsold.UserId=". $_SESSION['UserId'] .";";
        $con = Conexao::conectar();
        $stmt = $con->query($sql);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        Conexao::desconectar($con);
        
        $lstvenda = [];
        foreach ($result as $linha){
        $venda = new \MODEL\Venda();
        
        $venda->setId($linha['SoldId']);
        $venda->setTotal($linha['Total']);
        $venda->setEstado($linha['Estado']);
        $venda->setConsumer($linha['Nome']);
        $venda->setForma_pagto($linha['Forma_pagto']);
        $lstvenda[] = $venda;
        }
        return $lstvenda;
    }
    public function SelectSoldA() {
        //session_start();
        $sql = "SELECT mpgsold.SoldId, mpgsold.Total, mpgsold.Estado, IF(mpgsold.Forma_pagto = 1, 'Pix', 'Dinheiro') AS Forma_pagto, mpgconsumer.Nome  FROM mpgsold INNER JOIN mpgconsumer ON mpgsold.ConsumerId = mpgconsumer.ConsumerId WHERE mpgsold.Estado = 'A' AND mpgsold.UserId=". $_SESSION['UserId'] .";";
        $con = Conexao::conectar();
        $stmt = $con->query($sql);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        Conexao::desconectar($con);
        
        $lstvenda = [];
        foreach ($result as $linha){
        $venda = new \MODEL\Venda();
        
        $venda->setId($linha['SoldId']);
        $venda->setTotal($linha['Total']);
        $venda->setEstado($linha['Estado']);
        $venda->setConsumer($linha['Nome']);
        $venda->setForma_pagto($linha['Forma_pagto']);
        $lstvenda[] = $venda;
        }
        return $lstvenda;
    }
}

?>