<?php
namespace App\controllers;

use App\models\ResponsavelModel;
use App\Conexao\ConexaoBD;


class ResponsavelController{
    private $ResponsavelModelo;

    public function __construct(ConexaoBD $bd)
    {
        $this->ResponsavelModelo = new ResponsavelModel($bd);
        //$this->ResponsavelModelo = new ResponsavelModel($banco);
        
    }

    public function listarResponsavel()
    {
        $Responsavel = $this->ResponsavelModelo->obterResponsavel();
        include "App/views/Responsavel.php";
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