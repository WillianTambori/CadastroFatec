<?php
namespace App\controllers;

use App\models\CursoModel;
use App\Conexao\ConexaoBD;


class CursoController{
    private $CursoModelo;

    public function __construct(ConexaoBD $bd)
    {
        $this->CursoModelo = new CursoModel($bd);
        //$this->CursoModelo = new CursoModelo($banco);
        
    }

    public function listarCurso()
    {
        $Curso = $this->CursoModelo->obterCurso();
        include "App/views/Curso.php";
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