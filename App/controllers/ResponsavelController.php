<?php
namespace App\controllers;

use App\models;
use App\Conexao\ConexaoBD;


class ResponsavelController{

    private $ResponsavelModelo;
    private $CursoModelo;
    private $CadastroModelo;

    public function __construct(ConexaoBD $bd)
    {
        $this->CadastroModelo = new models\CadastroModel($bd);
        $this->ResponsavelModelo = new models\ResponsavelModel($bd);
        $this->CursoModelo = new models\CursoModel($bd);
        //$this->ResponsavelModelo = new ResponsavelModel($banco);
        
    }

    public function listarResponsavel()
    {
        if(isset($_POST['adicionar'])) $this->AdicionarResponsavel($_POST['nome'],$_POST['telefone'],$_POST['email']);
        if(isset($_POST['editar'])) $this->AlterarResponsavel($_POST['id'],$_POST['nome'],$_POST['telefone'],$_POST['email']);

        if(isset($_GET["id"]) && is_numeric($_GET["id"]) && isset($_GET["ex"])){
            if($_GET['ex'] === '1'){$Res = $this->ResponsavelModelo->obterResponsavelPorId($_GET['id']);}
            
            if($_GET['ex'] === '2'){$this->ResponsavelModelo->ExcluirResponsavel($_GET['id']);}
        }
        
        $Curso = $this->CursoModelo->obterCurso();
        $Responsavel = $this->ResponsavelModelo->obterResponsavel();
        //if(isset($_GET['id']))
        include "App/views/responsavel/Responsavel.php";
        if(isset($_GET['id'])){$Cadastro = $this->CadastroModelo->obterCadastroPorResponsavel($_GET['id']);
        include "App/views/responsavel/Agenda.php";
        
        }
    }
    public function ExcluirResponsavelPorId($cod){
        $Responsavel = $this->ResponsavelModelo->excluirResponsavel($cod);
    }
    public function AlterarResponsavel($codigo,$nome,$telefone,$email)
    {
        $Responsavel = $this->ResponsavelModelo->alterarResponsavel($codigo,$nome,$telefone,$email);   
    }
    public function AdicionarResponsavel($nome,$telefone,$email){
        $Responsavel= $this->ResponsavelModelo->adicionarResponsavel($nome,$telefone,$email);
    }
}

?>