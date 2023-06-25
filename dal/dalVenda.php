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

}

?>