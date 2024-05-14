<?php
namespace App\controllers;

use App\models;
use App\Conexao\ConexaoBD;


class ContatoController{
    private $ContatoModelo;
    private $CursoModelo;
    private $CadastroModelo;

    public function __construct(ConexaoBD $bd)
    {
        $this->ContatoModelo = new models\ContatoModel($bd);
        $this->CursoModelo = new models\CursoModel($bd);
        $this->CadastroModelo = new models\CadastroModel($bd);
        
    }   

    public function listarContato()
    {
        $Curso = $this->CursoModelo->obterCurso();
        $Contato = $this->ContatoModelo->obterContato();
        include "App/views/Contato/Contato.php";
    }
    public function ContatosPorCadastro($cadastro = null){
        
        if(isset($cadastro[0])){
            $contatos = [];
            for($i =0; $i < count($cadastro[0]);$i++){
                $cont = $this->ContatoModelo->obterContatoPorCadastro($cadastro[0][$i]);
                foreach($cont as $ctt){
                if($cadastro[1] === "Todos os cursos"){array_push($contatos,$ctt);}
                else{if($ctt['Curso_id'] === $cadastro[1]){array_push($contatos,$ctt);}}
                }
            }
            $Curso = $this->CursoModelo->obterCurso();
            $Cadastro = $this->CadastroModelo->obterCadastro();
            include_once "App/views/Contato/Cadastro.php";
        }
        else{
            $contatos =  [];
            $Curso = $this->CursoModelo->obterCurso();
            $Cadastro = $this->CadastroModelo->obterCadastro();
            include_once "App/views/Contato/Cadastro.php";

        }
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