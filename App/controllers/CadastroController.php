<?php
namespace App\controllers;

use App\models;
use App\Conexao\ConexaoBD;

class CadastroController{
    private $CadastroModelo;
    private $ResponsavelModelo;
    private $contatoModelo;
    private $CursoModelo;

    public function __construct(ConexaoBD $bd)
    {
        $this->CadastroModelo = new models\CadastroModel($bd);
        $this->ResponsavelModelo = new models\ResponsavelModel($bd);
        $this->contatoModelo = new models\ContatoModel($bd);
        $this->CursoModelo = new models\CursoModel($bd);

        //$this->CadastroModelo = new CadastroModelo($banco);
        
    }

    public function listarCadastro()
    {
        
        if(isset($_POST['adicionar'])) $this->AdicionarCadastro($_POST['Data'],$_POST['Forma'],$_POST['Responsavel_id']);
        if(isset($_POST['editar'])) $this->AlterarCadastro($_POST['id'],$_POST['Data'],$_POST['Forma'],$_POST['Responsavel_id']);

        if(isset($_GET["id"]) && is_numeric($_GET["id"]) && isset($_GET["ex"])){
            if($_GET['ex'] === '1'){$cadastro = $this->CadastroModelo->obterCadastroPorId($_GET['id']);}
            
            if($_GET['ex'] === '2'){$this->CadastroModelo->ExcluirCadastro($_GET['id']);}
        }
        $Curso = $this->CursoModelo->obterCurso();
        $Responsavel = $this->ResponsavelModelo->obterResponsavel();
        $Cadastro = $this->CadastroModelo->obterCadastro();
        if(!isset($_GET['ag'])){
            include "App/views/Agenda/Agendas.php";
            if(isset($_GET['id'])){$contatos = $this->contatoModelo->obterContatoPorCadastro($_GET['id']);
            include "App/views/Agenda/Contatos.php";
            }
        
        }else{
            $_GET['id'] = $_GET['ag'];
            include "App/views/responsavel/Responsavel.php";
            if(isset($_GET['id'])){$Cadastro = $this->CadastroModelo->obterCadastroPorResponsavel($_GET['id']);
            include "App/views/responsavel/Agenda.php";
            }
        }
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