<?php
   namespace dal;

use PDO;

class Conexao{
    private static $dbName='mofs'; 
    private static $dbHost = 'localhost';
    private static $dbUser = 'root'; 
    private static $dbPassword = '';  

    private static $cont = null; 

    public function __construct()
    {
        die("A função init não é permitida"); 
    }

    public static function conectar(){
        if (self::$cont == null){
            try{
               self::$cont = new  \PDO("mysql:host=". self::$dbHost .";dbname=" . self::$dbName , self::$dbUser, self::$dbPassword);
            }
            catch (\PDOException $exception) {
                die ($exception->getMessage());
            }
 
        }
        return self::$cont; 
    }

    public static function desconectar (){
        self::$cont = null; 
    }

}

?>