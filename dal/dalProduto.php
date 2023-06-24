<?php 
    namespace dal;

    include_once "conection.php";
    include_once "../../model/Produto.php";
    session_start();

    class dalProduto{
        
        public function Insert(\model\Produto $produto) {
            $con = \dal\Conexao::conectar();
            /*$id = $produto->getId();*/
            $Nome = $produto->getNome();
            $Preco_venda = $produto->getPreco_venda();
            $Preco_compra = $produto->getPreco_compra();
            $Cod_barra = $produto->getCod_barra();
            $Estoque = $produto->getEstoque();

            $sql = "CALL InsertProduct(:Nome, :Preco_venda, :Preco_compra, :Cod_barra, :Estoque,  :Insert_session, :UserId, @p_STATUS_CODE, @p_MESSAGE);";

            $stmt = $con->prepare($sql);

            $stmt->bindParam(':Nome', $Nome);
            $stmt->bindParam(':Preco_venda', $Preco_venda);
            $stmt->bindParam(':Preco_compra', $Preco_compra);
            $stmt->bindParam(':Cod_barra', $Cod_barra);
            $stmt->bindParam(':Estoque', $Estoque);

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

    public function Update(\model\Produto $produto) {
        $con = \dal\Conexao::conectar();

        $id = $produto->getId();
        $Nome = $produto->getNome();
        $Preco_venda = $produto->getPreco_venda();
        $Preco_compra = $produto->getPreco_compra();
        $Estoque = $produto->getEstoque();
        $token = HEX2BIN($_SESSION["Token"]);
        
        $sql = "UPDATE mpgproducts SET Update_date=NOW(), Update_session='". $token ."', Nome='". $Nome ."', Preco_venda='". $Preco_venda ."', Preco_compra='". $Preco_compra ."', Estoque='". $Estoque ."' WHERE ProductsId=". $id .";";

        echo $sql;
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();

        \dal\Conexao::desconectar();

        return  $result; 
    }

    public function Select() {
        $sql = "SELECT ProductsId, Nome, Preco_venda, Preco_compra, Cod_barra, Estoque FROM mpgproducts WHERE UserId = ". $_SESSION['UserId'] .";";
        $con = Conexao::conectar(); 
        $result = $con->query($sql); 
        $con = Conexao::desconectar();
        $lstProduto = [];
        if ($result != null){
            foreach ($result as $linha){
                $produto = new \MODEL\Produto(); 
                
                $produto->setId($linha['ProductsId']);
                $produto->setNome($linha['Nome']);
                $produto->setPreco_venda($linha['Preco_venda']);
                $produto->setPreco_compra($linha['Preco_compra']);
                $produto->setCod_barra($linha['Cod_barra']);
                $produto->setEstoque($linha['Estoque']);

                $lstProduto[] = $produto; 
            }
        }
        return $lstProduto; 
        
    }

    public function SelectConsumer($ProductsId) {
        $sql = "SELECT ProductsId, Nome, Preco_venda, Preco_compra, Cod_barra, Estoque FROM mpgproducts WHERE UserId = ". $_SESSION['UserId'] ." AND ProductsId=". $ProductsId ." ;";
        $con = Conexao::conectar();
        $stmt = $con->query($sql);
        $linha = $stmt->fetch(\PDO::FETCH_ASSOC);
        Conexao::desconectar($con);
    
        $produto = new \MODEL\Produto(); 
            
        $produto->setId($linha['ProductsId']);
        $produto->setNome($linha['Nome']);
        $produto->setPreco_venda($linha['Preco_venda']);
        $produto->setPreco_compra($linha['Preco_compra']);
        $produto->setCod_barra($linha['Cod_barra']);
        $produto->setEstoque($linha['Estoque']);
    
        return $produto;
    }

    public function Delete($ProductsId){
        $con = \dal\Conexao::conectar();

        $sql = "DELETE FROM mpgproducts WHERE ProductsId=". $ProductsId .";";

        $stmt = $con->prepare($sql);
        $result = $stmt->execute();

        \dal\Conexao::desconectar();

        return  $result; 
    }
}
?>