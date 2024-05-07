<?php
namespace App\controllers;

use App\models;
use App\Conexao\ConexaoBD;

class CadastroController{
    private $CadastroModelo;
    private $ResponsavelModelo;

    public function __construct(ConexaoBD $bd)
    {
        $this->CadastroModelo = new models\CadastroModel($bd);
        $this->ResponsavelModelo = new models\ResponsavelModel($bd);

        //$this->CadastroModelo = new CadastroModelo($banco);
        
    }

    public function listarCadastro()
    {
        $Responsavel = $this->ResponsavelModelo->obterResponsavel();
        $Cadastro = $this->CadastroModelo->obterCadastro();
        include "App/views/Cadastro.php";
    }
    public function ExcluirCadastroPorId($cod){
        $Cadastro = $this->CadastroModelo->excluirCadastro($cod);
    }
    public function AlterarCadastro($codigo,$Data,$Forma,$Responsavel_id)
    {
        $Cadastro = $this->CadastroModelo->alterarCadastro($codigo,$Data,$Forma,$Responsavel_id);   
    }
    public function AdicionarCadastro($Data,$Forma,$Responsavel_id){
        $Cadastro= $this->CadastroModelo->adicionarCadastro($Data,$Forma,$Responsavel_id);
    }
}

?>