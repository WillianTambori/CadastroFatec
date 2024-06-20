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
    public function obterContatoPorCurso($codigo)
    {
        return $this->conexao->executaSQL(" SELECT id,nome,email,Escola,whatzaap,aceitaContato,Cadastro_id  FROM Contato_has_Curso  inner join Contato  on whatzaap_id = whatzaap where Curso_id = $codigo ");

    }

    public function obterContatoPorCadastro($cadastro)
    {
        return $this->conexao->executaSQL("SELECT * FROM Contato WHERE Cadastro_id = $cadastro ");
    }
    
    public function adicionarContato($nome, $email, $Escola, $whatzaap, $aceitaContato, $Cadastro_id, $Curso_id)
    {
        $comandoSQL = "INSERT INTO Contato (nome, email, Escola, whatzaap, aceitaContato, Cadastro_id) values ('$nome','$email','$Escola','$whatzaap','$aceitaContato','$Cadastro_id'); ";
        //$this->conexao->executaComando($comandoSQL);
        for($i =0; $i < count($Curso_id);$i++){
            $comandoSQL .= "INSERT INTO Contato_has_Curso ( whatzaap_id, Curso_id ) values ('$whatzaap','$Curso_id[$i]'); ";
        }
        $this->conexao->executaComando($comandoSQL);

    }
    public function alterarContato($codigo, $nome, $email, $Escola, $whatzaap, $aceitaContato, $Cadastro_id, $Curso_id)
    {
        $comandoSQL = "UPDATE Contato SET nome ='$nome', email='$email', Escola ='$Escola', whatzaap='$whatzaap', aceitaContato='$aceitaContato', Cadastro_id='$Cadastro_id' WHERE id = $codigo ; ";
        $comandoSQL .= "DELETE FROM Contato_has_Curso WHERE whatzaap_id = $whatzaap ; ";
        for($i =0; $i < count($Curso_id);$i++){
            $comandoSQL .= "INSERT INTO Contato_has_Curso ( whatzaap_id, Curso_id ) values ('$whatzaap','$Curso_id[$i]'); ";
        }
        $this->conexao->executaComando($comandoSQL);
        return $this->conexao->executaComando($comandoSQL);

    }
    public function excluirContato($codigo)
    {
        $comandoSQL = "DELETE FROM Contato WHERE id = $codigo";
        return $this->conexao->executaComando($comandoSQL);
        
        
    }
}

?>