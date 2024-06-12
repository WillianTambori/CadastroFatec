<?php

namespace App\models;
use App\Conexao\ConexaoBD;

class CadastroModel{
    private $conexao; // ConexaoBD

    public function __construct($bd)
    {
        $this->conexao = $bd;

        
    }
    
    public function obterCadastro()
    {
        return $this->conexao->executaSQL("SELECT * FROM Cadastro");

    }
    public function obterCadastroPorId($codigo)
    {
        return $this->conexao->executaSQL("SELECT * FROM Cadastro WHERE id = '$codigo' ");

    }
    public function obterCadastroPorResponsavel($codigo)
    {
        return $this->conexao->executaSQL("SELECT * FROM Cadastro WHERE Responsavel_id = '$codigo' ");

    }
    
    public function adicionarCadastro($Data,$Forma,$Responsavel_id)
    {
        $comandoSQL = "INSERT INTO Cadastro (Data,Forma,Responsavel_id) values ('$Data','$Forma','$Responsavel_id')";
        $this->conexao->executaComando($comandoSQL);

    }
    public function alterarCadastro($codigo,$Data,$Forma,$Responsavel_id)
    {
        $comandoSQL = "UPDATE Cadastro SET Data ='$Data', Forma ='$Forma', Responsavel_id ='$Responsavel_id'  WHERE id = $codigo";
        return $this->conexao->executaComando($comandoSQL);

    }
    public function excluirCadastro($codigo)
    {
        $comandoSQL = "DELETE FROM Cadastro WHERE id = $codigo";
        return $this->conexao->executaComando($comandoSQL);
        
        
    }
}