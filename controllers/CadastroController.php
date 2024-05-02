<?php
require_once "ConexaoBD.php";
require_once "models/CadastroModel.php";

class CadastroController{
    private $CadastroModelo;

    public function __construct(ConexaoBD $bd)
    {
        $this->CadastroModelo = new CadastroModel($bd);
        //$this->CadastroModelo = new CadastroModelo($banco);
        
    }

    public function listarCadastro()
    {
        $Cadastro = $this->CadastroModelo->obterCadastro();
        include "views/Cadastro.php";
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