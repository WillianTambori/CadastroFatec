<?php

// Endpoint URL
$url = 'http://localhost:3000/session/qr/teste123/image';

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
    echo '<img src="data:image/png;base64,' . base64_encode($image) . '" alt="Imagem">';
}

?>