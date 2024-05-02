<?php
require_once "models/ContatoModel.php";

class ContatoController{
    private $ContatoModelo;

    public function __construct(ConexaoBD $bd)
    {
        $this->ContatoModelo = new ContatoModel($bd);
        
    }

    public function listarContato()
    {
        $Contato = $this->ContatoModelo->obterContato();
        include "views/Contato.php";
    }
    public function ExcluirContatoPorId($cod){
        $Contato = $this->ContatoModelo->excluirContato($cod);
    }
    public function AlterarContato($Codigo,$nome, $email, $Escola, $whatzaap, $aceitaContato, $Cadastro_id)
    {
        $Contato = $this->ContatoModelo->alterarContato($Codigo,$nome, $email, $Escola, $whatzaap, $aceitaContato, $Cadastro_id);   
    }
    public function AdicionarContato($nome, $email, $Escola, $whatzaap, $aceitaContato, $Cadastro_id){
        $Contato= $this->ContatoModelo->adicionarContato($nome, $email, $Escola, $whatzaap, $aceitaContato, $Cadastro_id);
    }
}

?>