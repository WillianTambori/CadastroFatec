<?php

namespace App\models;

class ZaapModel{
    private $url;

    public function __construct($Ses)
    {
        $this->url = $Ses;
        
    }
    public function Init(){
        // URL do endpoint
        $url = 'http://localhost:3000/session/start/'.$this->url;

        // Cabeçalhos da solicitação
        $headers = array(
            'accept: application/json',
            'x-api-key: comunidadezdg.com.br'
        );

        // Inicializa a sessão cURL
        $curl = curl_init($url);

        // Define as opções da sessão cURL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Retorna a resposta como string
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // Define os cabeçalhos da solicitação
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Desabilita a verificação do certificado SSL (use com cautela)

        // Executa a solicitação
        $response = curl_exec($curl);
        // Verifica se houve algum erro
        if ($response === false) {
            $error = curl_error($curl);
            return $error;
        } else {
            // Imprime a resposta
            return $response;
        }

        // Fecha a sessão cURL
        curl_close($curl);
    }
    public function Qrcod(){
        

        // Endpoint URL
        $url = 'http://localhost:3000/session/qr/'.$this->url.'/image';

        // Configuração da solicitação
        $options = array(
            'http' => array(
                'method' => 'GET',
                'header' => "accept: image/png\r\n" .
                            "x-api-key: comunidadezdg.com.br\r\n"
            )
        );

        // Cria um contexto para a solicitação
        $context = stream_context_create($options);

        // Faz a solicitação e obtém a imagem
        $image = file_get_contents($url, false, $context);

        // Verifica se houve erro ao obter a imagem
        if ($image === false) {
            echo 'Erro ao obter a imagem.';
        } else {
            // Define o cabeçalho para exibir a imagem
            //header('Content-Type: image/png');
            // Exibe a imagem diretamente no navegador
            //echo $image;
            return $image;
        }
    }
    
    public function status(){
        $url = 'http://localhost:3000/session/status/' . $this->url;

        // Inicializa a sessão cURL
       $headers = array(
            'accept: application/json',
            'x-api-key: comunidadezdg.com.br'
        );

        // Inicializa a sessão cURL
        $curl = curl_init($url);

        // Define as opções da sessão cURL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Retorna a resposta como string
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // Define os cabeçalhos da solicitação
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Desabilita a verificação do certificado SSL (use com cautela)

        // Executa a solicitação
        $response = curl_exec($curl);

        // Verifica por erros
        if(curl_errno($curl)){
            return curl_error($curl);
        }

        // Fecha a sessão cURL
        curl_close($curl);
        
        return $response;
        // Exibe a resposta

    }
    public function tag(){
        // URL do endpoint
        $url = 'http://localhost:3000/session/qr/'.$this->url;

        // Inicializa a sessão cURL
        $ch = curl_init();

        // Configura as opções da requisição
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: */*',
            'x-api-key: comunidadezdg.com.br'
        ));

        // Executa a requisição
        $response = curl_exec($ch);

        // Verifica por erros
        if(curl_errno($ch)){
            echo 'Erro ao enviar a requisição: ' . curl_error($ch);
        }

        // Fecha a sessão cURL
        curl_close($ch);

        // Exibe a resposta
        return $response;
    }
    public function mensagem($contato,$mensagem){
    
        // Dados da solicitação
        $url = 'http://localhost:3000/client/sendMessage/'.$this->url;
        $headers = [
            'accept: */*',
            'x-api-key: comunidadezdg.com.br',
            'Content-Type: application/json',
        ];
        $data = [
            'chatId' => '55'.$contato .'@c.us',
            'contentType' => 'string',
            'content' => $mensagem,
        ];

        // Inicializa a sessão curl
        $curl = curl_init();

        // Configura as opções da solicitação
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => $headers,
        ]);

        // Executa a solicitação e obtém a resposta
        $response = curl_exec($curl);

        // Verifica por erros
        if (curl_errno($curl)) {
            return curl_error($curl);
        }

        // Fecha a sessão curl
        curl_close($curl);

        // Exibe a resposta
        return $response;
    }
    
    public function imagem($numero,$imagem){
            // Dados da foto a ser enviada
        $filename = "./App/views/temporario/".$imagem;
        $mimetype = mime_content_type($filename);
        $data = base64_encode(file_get_contents($filename));

        // Dados da requisição
        $url = 'http://localhost:3000/client/sendMessage/' . $this->url;
        $headers = [
            'accept: */*',
            'x-api-key: comunidadezdg.com.br',
            'Content-Type: application/json',
        ];

        // Corpo da requisição
        $data = [
            'chatId' => '55'.$numero . '@c.us',
            'contentType' => 'MessageMedia',
            'content' => [
                'mimetype' => $mimetype,
                'data' => $data,
                'filename' => basename($filename),
            ],
        ];

        // Inicializa a sessão cURL
        $ch = curl_init($url);

        // Configurações da requisição
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Executa a requisição e obtém a resposta
        $response = curl_exec($ch);

        // Verifica por erros
        if (curl_errno($ch)) {
            return curl_error($ch);
        } else {
            // Exibe a resposta do servidor
            return $response;
        }

        // Fecha a sessão cURL
        curl_close($ch);
    }

    public function encerrar(){
        $url = 'http://localhost:3000/session/terminateAll';
        $headers = array(
            'accept: application/json',
            'x-api-key: comunidadezdg.com.br'
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        // Verifica por erros
        if(curl_errno($curl)){
            return curl_error($curl);
        }

        // Fecha a sessão cURL
        curl_close($curl);
        
        return $response;
        // Exibe a resposta
    }

    public function numZaap(){
        $url = 'http://localhost:3000/client/getClassInfo/' . $this->url;
        $headers = array(
            'accept: */*',
            'x-api-key: comunidadezdg.com.br'
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            return $response;
        } else {
            return $response;
        }

        curl_close($ch);
    }
    public function Url($contato,$urlParam){
        // URL do endpoint
        $url = 'http://localhost:3000/client/sendMessage/'.$this->url;

        // Dados da solicitação
        $data = array(
            'chatId' => '55'.$contato.'@c.us',
            'contentType' => 'MessageMediaFromURL',
            'content' => $urlParam
        );

        // Cabeçalhos da solicitação
        $headers = array(
            'accept: */*',
            'x-api-key: comunidadezdg.com.br',
            'Content-Type: application/json'
        );

        // Inicializa uma nova sessão cURL
        $curl = curl_init();

        // Define as opções da sessão cURL
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => $headers
        ));

        // Executa a solicitação e obtém a resposta
        $response = curl_exec($curl);

        // Verifica se houve algum erro
        if (curl_errno($curl)) {
            return curl_error($curl);
        }

        // Fecha a sessão cURL
        curl_close($curl);

        // Exibe a resposta
        return $response;


        }


}