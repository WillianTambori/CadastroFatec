<?php 

namespace App\models;
use App\Conexao\ConexaoBD;

class ContatoModel{
    private $conexao; // ConexaoBD

    public function __construct($bd)
    {
        $this->conexao = $bd;

        
    }
    
    public function obterContato()
    {
        return $this->conexao->executaSQL("SELECT * FROM Contato");

    }
    public function obterContatoPorId($codigo)
    {
        return $this->conexao->executaSQL("SELECT * FROM Contato WHERE id = $codigo ");

    }
    
    public function adicionarContato($nome, $email, $Escola, $whatzaap, $aceitaContato, $Cadastro_id, $Curso_id)
    {
        $comandoSQL = "INSERT INTO Contato (nome, email, Escola, whatzaap, aceitaContato, Cadastro_id, Curso_id) values ('$nome','$email','$Escola','$whatzaap','$aceitaContato','$Cadastro_id','$Curso_id')";
        $this->conexao->executaComando($comandoSQL);

    }
    public function alterarContato($codigo, $nome, $email, $Escola, $whatzaap, $aceitaContato, $Cadastro_id,$Curso_id)
    {
        $comandoSQL = "UPDATE Contato SET nome ='$nome', email='$email', Escola ='$Escola', whatzaap='$whatzaap', aceitaContato='$aceitaContato', Cadastro_id='$Cadastro_id', Curso_id = '$Curso_id' WHERE id = $codigo";
        return $this->conexao->executaComando($comandoSQL);

    }
    public function excluirContato($codigo)
    {
        $comandoSQL = "DELETE FROM Contato WHERE id = $codigo";
        return $this->conexao->executaComando($comandoSQL);
        
        
    }
}

?>