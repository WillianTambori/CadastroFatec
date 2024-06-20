<?php


namespace App\models;
use App\Conexao\ConexaoBD;

class CursoModel{
    private $conexao; // ConexaoBD

    public function __construct($bd)
    {
        $this->conexao = $bd;

        
    }
    
    public function obterCurso()
    {
        return $this->conexao->executaSQL("SELECT * FROM Curso");

    }
    public function obterCursoPorId($codigo)
    {
        return $this->conexao->executaSQL("SELECT * FROM Curso WHERE id = $codigo ");

    }
    public function obterCursoPorContato($whatzaap)
    {
        return $this->conexao->executaSQL("SELECT * FROM Contato_has_Curso WHERE whatzaap_id = $whatzaap");

    }
    
    public function adicionarCurso($curso,$periodo,$Responsavel_id)
    {
        $comandoSQL = "INSERT INTO Curso (curso,periodo,Responsavel_id) values ('$curso','$periodo','$Responsavel_id')";
        $this->conexao->executaComando($comandoSQL);

    }
    public function alterarCurso($codigo,$curso,$periodo,$Responsavel_id)
    {
        $comandoSQL = "UPDATE Curso SET curso ='$curso', periodo ='$periodo', Responsavel_id ='$Responsavel_id'  WHERE id = $codigo";
        return $this->conexao->executaComando($comandoSQL);

    }
    public function excluirCurso($codigo)
    {
        $comandoSQL = "DELETE FROM Curso WHERE id = $codigo";
        return $this->conexao->executaComando($comandoSQL);
        
        
    }
}