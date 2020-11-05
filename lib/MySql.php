<?php
class MySql{


         private static $con;

         public static function conect(){
             $host = 'localhost';
             $dbname = 'sisrecsenha';
             $user = 'root';
            $password = '';
            if(self::$con == null){
                self::$con = new mysqli($host, $user, $password, $dbname);
            }
            if(mysqli_connect_errno()){
            exit("Erro ao conectar-se com o banco de dados. ERRO: ".mysqli_connect_error());
            }
            return self::$con;
        }
    }
?>