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
        $Responsavel = $this->ResponsavelModelo->obterResponsavel();
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