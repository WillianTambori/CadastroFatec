<?php
namespace App\controllers;

use App\models;
use App\Conexao\ConexaoBD;


class ContatoController{
    private $ContatoModelo;
    private $CursoModelo;

    public function __construct(ConexaoBD $bd)
    {
        $this->ContatoModelo = new models\ContatoModel($bd);
        $this->CursoModelo = new models\CursoModel($bd);
        
    }   

    public function listarContato()
    {
        $Curso = $this->CursoModelo->obterCurso();
        $Contato = $this->ContatoModelo->obterContato();
        include "App/views/Contato.php";
    }
    public function ExcluirContatoPorId($cod){
        $Contato = $this->ContatoModelo->excluirContato($cod);
    }
    public function AlterarContato($Codigo,$nome, $email, $Escola, $whatzaap, $aceitaContato, $Cadastro_id,$Curso_id)
    {
        $Contato = $this->ContatoModelo->alterarContato($Codigo,$nome, $email, $Escola, $whatzaap, $aceitaContato, $Cadastro_id,$Curso_id);   
    }
    public function AdicionarContato($nome, $email, $Escola, $whatzaap, $aceitaContato, $Cadastro_id,$Curso_id){
        $Contato= $this->ContatoModelo->adicionarContato($nome, $email, $Escola, $whatzaap, $aceitaContato, $Cadastro_id,$Curso_id);
    }
}

?>