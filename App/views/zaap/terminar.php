<?php
if($resposta->success){
    echo 'sessões desconectadas';
}else{
    echo 'nenhuma sessão encontrada';
};
?>
<br>
<a class="btn btn-outline-primary btn-sm" href="index.php?class=Zaap&acao=iniciar" role="button">iniciar sessão</a>