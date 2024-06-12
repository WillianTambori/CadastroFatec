<?php
if($resposta->success){
    echo 'sessão iniciada';
}else{
    echo 'sessão não encontrada';
};
?>
<br>
<a class="btn btn-outline-primary btn-sm" href="index.php?class=Zaap&acao=iniciar" role="button">conectar</a>