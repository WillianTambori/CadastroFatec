<?php
namespace App\controllers;

use App\models;
use App\Conexao\ConexaoBD;
use App\models\ContatoModel;
use Exception;

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
        
        if(isset($_GET['ag'])){
            
            if(isset($_POST['adicionar']))
            {
                if(isset($_POST['Curso_id']))$this->AdicionarContato($_POST['nome'],$_POST['email'],$_POST['Escola'],$_POST['whatzaap'],isset($_POST['aceitaContato'])?1:0,$_POST['Cadastro_id'],$_POST['Curso_id']);
                else{
                    $cs = "Erro: Curso não escolhido";
                    include_once "App/views/Erro.php";
                } 
            }
                if(isset($_POST['editar'])) $this->alterarContato($_POST['id'],$_POST['nome'],$_POST['email'],$_POST['Escola'],$_POST['whatzaap'],isset($_POST['aceitaContato'])?1:0,$_POST['Cadastro_id'],$_POST['Curso_id']);

            if(isset($_GET["id"]) && is_numeric($_GET["id"]) && isset($_GET["ex"])){
                if($_GET['ex'] === '1'){
                    $cadastro = $this->ContatoModelo->obterContatoPorId($_GET['id']);
                    $ct = $this->ContatoModelo->obterContatoPorId($_GET['id']);
                    $CursoInscrito = $this->CursoModelo->obterCursoPorContato($ct[0]['whatzaap']);}
                
                if($_GET['ex'] === '2'){$this->ContatoModelo->excluirContato($_GET['id']);}
            }
            
            $Curso = $this->CursoModelo->obterCurso();
            $contatos = $this->ContatoModelo->obterContatoPorCadastro($_GET['ag']);
            include "App/views/Contato/PorCadastro.php";
        }else{
            $Cadastro = $this->CadastroModelo->obterCadastro();
            $Curso = $this->CursoModelo->obterCurso();
            $header = ["Id","Nome","Email","Escola","WhatsApp","Contato","Cadastro"];
            if(isset($_POST['cs'])){
                 if($_POST['cs'] !== "Todos" ){
                    $contato = $this->ContatoModelo->obterContatoPorCurso($_POST['cs']); 
                 }else{$contato = $this->ContatoModelo->obterContato();}
                $contatos = $this->visualizar($Cadastro, $Curso, $contato);
            }
            if(isset($_POST["PDF"])){
                $this->gerarPdf($header,$contatos);
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename=' . basename('./App/views/arquivos/file.csv'));
                ob_clean();
                flush();
                readfile('./App/views/arquivos/file.csv');
                exit;
            }
            include "App/views/Contato/Contato.php";
        }
        
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
    public function gerarPdf($header,$dados){

        //header('Content-Type: text/csv; charset=utf-8');
        //header('Content-Dispositivo: attachment; filename=arquivo.csv');
        $this->ContatoModelo->obterContato();
        $arquivo = fopen('./App/views/arquivos/file.csv','w');

        fputcsv($arquivo, $header,';');
        foreach($dados as $row){
            fputcsv($arquivo, $row,';');
        }
        fclose($arquivo);
    }
    public function visualizar($cadastro, $curso, $contatos){
        $res = $contatos;
        
        // Função para obter o nome pelo ID do curso
        function Curs($array, $id, $curso){
            foreach ($array as $ar){
                if ($ar["id"] === $id){
                    return $ar["curso"];
                }
            }
            return ''; // Retornar uma string vazia se o ID não for encontrado
        }
        
        // Função para obter a forma pelo ID do cadastro
        function Cad($array, $id, $cadastro){
            foreach ($array as $ar){
                if (intval($ar["id"]) === $id){
                    return $ar['Forma'];
                }
            }
            return ''; // Retornar uma string vazia se o ID não for encontrado
        }
        
        // Iterar sobre os contatos e atualizar os IDs com os respectivos nomes e formas
        foreach ($res as &$ctt){
            foreach ($ctt as $ct => $cto){
                if ($ct === "Cadastro_id") $ctt['Cadastro_id'] = Cad($cadastro, $cto, $cadastro);
                if ($ct === "aceitaContato") $ctt["aceitaContato"] = $ctt["aceitaContato"]?"sim":"não" ;
            }
        }
        
        return $res;
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
    public function Teste(){
        $whatzaap = '123';
        $cs = $this->CursoModelo->obterCursoPorContato($whatzaap);
        $Curso = $this->CursoModelo->obterCurso();
        include_once "App/views/TestePost.php";
    }

    
}

?>