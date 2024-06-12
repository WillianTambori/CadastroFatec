<?php
namespace App\controllers;

use App\models;
use App\Conexao\ConexaoBD;


class zaapController{
    private $conection;
    private $contatoModelo;
    private $cursoModelo;
    private $cadastroModelo;

    public function __construct(ConexaoBD $bd)
    {
        $this->conection = new models\ZaapModel("teste123");
        $this->contatoModelo = new models\ContatoModel($bd);
        $this->cursoModelo = new models\CursoModel($bd);
        $this->cadastroModelo = new models\CadastroModel($bd);
        
        
    }
    public function iniciar($cadastro = null){
        $resposta = json_decode($this->conection->Init());
        if(isset($resposta->success)){
            if(isset($cadastro[0]))
                {
                    $usuario = json_decode($this->conection->numZaap());
                    include "App/views/zaap/usuario.php";
                    $this->contatos($cadastro);}
            else{
                if($resposta->success){
                    include "App/views/zaap/iniciar.php";
                }else{
                    $usuario = json_decode($this->conection->numZaap());
                    if($usuario->success){
                        
                        include "App/views/zaap/usuario.php";
                        $this->contatos();
                        
                    }else{

                        $imagem = $this->conection->Qrcod();
                        include "App/views/zaap/qr.php";
                    }

                }
            }
        }else echo "Api, não conectada";
        
    }
    public function contatos($cadastro = null){
        if(isset($cadastro[0])){
            $contatos = [];
            $telefones = [];
            for($i =0; $i < count($cadastro[0]);$i++){
                $cont = $this->contatoModelo->obterContatoPorCadastro($cadastro[0][$i]);
                foreach($cont as $ctt){
                if($cadastro[1] === "Todos os cursos"){array_push($contatos,$ctt);}
                else{
                    if(intval($cadastro[1]) === $ctt['Curso_id'])
                    array_push($contatos,$ctt);
                }
                }
            }
            if(count($contatos) > 0 ){
            foreach($contatos as $ctt){
                if($ctt['aceitaContato'] === 1){
                array_push($telefones,$ctt['whatzaap']);
            }}}
            $Curso = $this->cursoModelo->obterCurso();
            $Cadastro = $this->cadastroModelo->obterCadastro();
            include_once "App/views/zaap/disparar.php";
        }
        else{
            $contatos =  [];
            $Curso = $this->cursoModelo->obterCurso();
            $Cadastro = $this->cadastroModelo->obterCadastro();
            include_once "App/views/zaap/disparar.php";

        }
    }
    public function conectar(){
        $imagem = $this->conection->Qrcod();
        include "App/views/zaap/qr.php";

    }
    
    public function verificar(){
        $resposta = json_decode($this->conection->status());
        include "App/views/zaap/enviarMsn.php";
    }
    public function enviar($param){
        $resposta = json_decode($this->conection->mensagem($param[0],$param[1]));
        include "App/views/zaap/enviarMsn.php";

    }
    public function midia($param){
        $resposta = json_decode($this->conection->imagem($param[0],$param[1]));
        include "App/views/zaap/enviarMsn.php";


    }
    public function terminar(){
        $resposta = json_decode($this->conection->encerrar());
        include "App/views/zaap/terminar.php";

    }
    public function numero(){
        $usuario = json_decode($this->conection->numZaap());
        include "App/views/zaap/usuario.php";
    }
    public function dispararMsn($param){
        
        $usuario = json_decode($this->conection->numZaap());
        $Cadastro = $this->cadastroModelo->obterCadastro();
        $contatos =  [];
        $tel = [];
        if(isset($param[0])){
        $numeros = json_decode($param[0]);
            for($i = 0;$i < count($numeros);$i++){
                $num = $numeros[$i];
                $res = json_decode($this->conection->mensagem($num,$param[1]));
               
                if($res->success){
                    $tels = array("resultado" => true, "numero" => $res->message->_data->to->user);}
                    else{$tels = array("resultado" => false, "numero" => $num);}

                array_push($tel,$tels);

            }
            include "App/views/zaap/usuario.php";
            include_once "App/views/zaap/disparar.php";

        }
    }
    public function dispararMidia($param){
        
        $usuario = json_decode($this->conection->numZaap());
        $Cadastro = $this->cadastroModelo->obterCadastro();
        $contatos =  [];
        $tel = [];
        if(isset($param[0]) && isset($param[1]['tmp_name']) && isset($param[1]['name'])){
        $numeros = json_decode($param[0]);
            for($i = 0;$i < count($numeros);$i++){
                $num = $numeros[$i];
                $temporario = $param[1]['tmp_name'];
                $nome = $param[1]['name'];
                move_uploaded_file($temporario, './App/views/temporario/' . $nome);
                $res = json_decode($this->conection->imagem($num,$nome));
               
                if($res->success){
                    $tels = array("resultado" => true, "numero" => $res->message->_data->to->user);}
                    else{$tels = array("resultado" => false, "numero" => $num);}

                array_push($tel,$tels);

            }
            include "App/views/zaap/usuario.php";
            include_once "App/views/zaap/disparar.php";

        }
    
    }
    public function dispararUrl($param){
        
        $usuario = json_decode($this->conection->numZaap());
        $Cadastro = $this->cadastroModelo->obterCadastro();
        $contatos =  [];
        $tel = [];
        if(isset($param[0])){
        $numeros = json_decode($param[0]);
            for($i = 0;$i < count($numeros);$i++){
                $num = $numeros[$i];
                $res = json_decode($this->conection->Url($num,$param[1]));
               
                if($res->success){
                    $tels = array("resultado" => true, "numero" => $res->message->_data->to->user);}
                    else{$tels = array("resultado" => false, "numero" => $num);}

                array_push($tel,$tels);

            }
            include "App/views/zaap/usuario.php";
            include_once "App/views/zaap/disparar.php";

        }
    
    }

}