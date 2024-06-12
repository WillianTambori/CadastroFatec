<?php
namespace App\controllers;

use App\models;
use App\Conexao\ConexaoBD;


class CursoController{
    private $CursoModelo;
    private $ResponsavelModelo;

    public function __construct(ConexaoBD $bd)
    {
        $this->CursoModelo = new models\CursoModel($bd);
        $this->ResponsavelModelo = new models\ResponsavelModel($bd);

        //$this->CursoModelo = new CursoModelo($banco);
        
    }

    public function listarCurso()
    {
        if(isset($_POST['adicionar'])) $this->AdicionarCurso($_POST['curso'],$_POST['periodo'],$_POST['Responsavel_id']);
        if(isset($_POST['editar'])) $this->AlterarCurso($_POST['id'],$_POST['curso'],$_POST['periodo'],$_POST['Responsavel_id']);

        if(isset($_GET["id"]) && is_numeric($_GET["id"]) && isset($_GET["ex"])){
            if($_GET['ex'] === '1'){$Res = $this->CursoModelo->obterCursoPorId($_GET['id']);}
            
            if($_GET['ex'] === '2'){$this->CursoModelo->ExcluirCurso($_GET['id']);}
        }
        
        $Responsavel = $this->ResponsavelModelo->obterResponsavel();
        $Cursos = $this->CursoModelo->obterCurso();
        include "App/views/curso/Curso.php";
        
    }
    
    public function ExcluirCursoPorId($cod){
        $Curso = $this->CursoModelo->excluirCurso($cod);
    }
    public function AlterarCurso($codigo,$curso,$periodo,$Responsavel_id)
    {
        $Curso = $this->CursoModelo->alterarCurso($codigo,$curso,$periodo,$Responsavel_id);   
    }
    public function AdicionarCurso($curso,$periodo,$Responsavel_id){
        $Curso= $this->CursoModelo->adicionarCurso($curso,$periodo,$Responsavel_id);
    }
}

?>