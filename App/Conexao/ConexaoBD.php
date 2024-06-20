<?php
namespace App\Conexao;

use \PDO;
use \PDOException;

class ConexaoBD{
    
    // private $caminho;
    // private $nomeBanco;
    // private $nomeUsuario;
    // private $senhaBanco;
    private $conexao;

    public function __construct($host, $dbname,$username,$password)
    {
        // $this->caminho = $host;
        // $this->nomeBanco = $dbname;
        // $this->nomeUsuario = $username;
        // $this->senhaBanco = $password;

        try {
            //criar a conexão com o banco/host
            $this->conexao = new PDO("mysql:host={$host};dbname={$dbname}",$username,$password);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e){
            die("erro ao conectar com o banco de dados".$e->getMessage());
        }
        
    }  

    public function executaSQL($comandoSQL)
    {
        # return registtos selecionados no banco
        try{
            $acesso = $this->conexao->query($comandoSQL); // query utilzado para select 
            $resultado = $acesso->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }
        catch(PDOException $e){
            die("Erro ao executar a consulta (select)" . $e->getMessage());
        }
    }

    //serve para insert, update e delete
    public function executaComando($comandoSQL)
    {
        # return true ou false
        try{
            // query para select
            $acesso = $this->conexao->prepare($comandoSQL); // prepare utiliza insert, update e delete
            $acesso->execute();
            return true;

        }catch(PDOException $e){
            if ($e->getCode() == 23000) {
               if($e->errorInfo[1] == 1062)$cs = "Erro: O registro já existe";
               if($e->errorInfo[1] == 1451)$cs = "Erro: O registro está em uso";
               include_once "App/views/Erro.php";
            } else {
                // Capturar outros erros
                echo "<h1>Erro<h1>: " . $e->getMessage();
            }

        }
    }
}




?>