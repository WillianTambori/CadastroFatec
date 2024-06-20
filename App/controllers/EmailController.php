<?php
namespace App\controllers;

use App\models;
use App\Conexao\ConexaoBD;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class EmailController{
    private $email;
    private $contatoModelo;
    private $cursoModelo;
    private $cadastroModelo;

    public function __construct(ConexaoBD $bd)
    {
        $this->email = new PHPMailer(true);
        $this->contatoModelo = new models\ContatoModel($bd);
        $this->cursoModelo = new models\CursoModel($bd);
        $this->cadastroModelo = new models\CadastroModel($bd);
    }
    public function enviar($cadastro = null){

        
        if(isset($cadastro[0]))
            {
                $this->contatos($cadastro);}
        else
        {
            $this->contatos();
        }
    }
    public function contatos($cadastro = null){
        if(isset($cadastro[0])){
            $contatos = [];
            $emails = [];
            for($i =0; $i < count($cadastro[0]);$i++){
                $cont = $this->contatoModelo->obterContatoPorCadastro($cadastro[0][$i]);
                foreach($cont as $ctt){
                if($cadastro[1] === "Todos os cursos"){array_push($contatos,$ctt);}
                else{
                    $CursoEscolhido = $this->cursoModelo->obterCursoPorContato($ctt["whatzaap"]);
                    foreach($CursoEscolhido as $ct){
                        if(intval($cadastro[1]) === $ct['Curso_id'])
                        array_push($contatos,$ctt);
                    }
                }
                }
            }
            if(count($contatos) > 0 ){
            foreach($contatos as $ctt){
                if($ctt['aceitaContato'] === 1){
                array_push($emails,$ctt['email']);
            }}}
            $Curso = $this->cursoModelo->obterCurso();
            $Cadastro = $this->cadastroModelo->obterCadastro();
            include_once "App/views/email/enviar.php";
        }
        else{
            $contatos =  [];
            $Curso = $this->cursoModelo->obterCurso();
            $Cadastro = $this->cadastroModelo->obterCadastro();
            include_once "App/views/email/enviar.php";

        }
    }
    public function SMTB(){
        try {
            //Server settings
            $this->email->SMTPDebug = SMTP::DEBUG_SERVER;                     
            $this->email->isSMTP();                                            
            $this->email->Host       = 'correio.policiamilitar.sp.gov.br';                     
            $this->email->SMTPAuth   = true;                                   
            $this->email->Username   = '39253751800';                     
            $this->email->Password   = 'Hoa.3579';                               
            $this->email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;           
            $this->email->Port       = 465;                                 

            //Recipients
            $this->email->setFrom('msn.willian@gmail.com', 'willian');
            $this->email->addAddress('msn.willian@gmail.com', 'willian');     //Add a recipient
            //$this->email->addAddress('ellen@example.com');               //Name is optional
          
            
            //Attachments
            //$this->email->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$this->email->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $this->email->isHTML(true);                                  //Set email format to HTML
            $this->email->Subject = 'Teste2';
            $this->email->Body    = 'boa tarde email enviado!!! <b>in bold!</b>';
            $this->email->AltBody = 'email em forma de texto non-HTML mail clients';
        
            $this->email->send();
            echo 'email enviado com sucesso';
        } catch (Exception $e) {
            echo "email não enviado: {$this->email->ErrorInfo}";
        }
    }
}
?>