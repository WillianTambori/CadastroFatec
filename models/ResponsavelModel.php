<?php
require_once "ConexaoBD.php";
class ResponsavelModel{
    private $conexao; // ConexaoBD

    public function __construct($bd)
    {
        $this->conexao = $bd;

        
    }
    
    public function obterResponsavel()
    {
        return $this->conexao->executaSQL("SELECT * FROM Responsavel");

    }
    public function obterResponsavelPorId($codigo)
    {
        return $this->conexao->executaSQL("SELECT * FROM Responsavel WHERE id = $codigo ");

    }
    
    public function adicionarResponsavel($nome,$telefone,$email)
    {
        $comandoSQL = "INSERT INTO Responsavel (nome, telefone, email) values ('$nome','$telefone','$email')";
        $this->conexao->executaComando($comandoSQL);

    }
    public function alterarResponsavel($codigo,$nome,$telefone,$email)
    {
        $comandoSQL = "UPDATE Responsavel SET nome ='$nome', telefone ='$telefone', email ='$email'  WHERE id = $codigo";
        return $this->conexao->executaComando($comandoSQL);

    }
    public function excluirResponsavel($codigo)
    {
        $comandoSQL = "DELETE FROM Responsavel WHERE id = $codigo";
        return $this->conexao->executaComando($comandoSQL);
        
        
    }
}