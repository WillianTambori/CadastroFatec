<div class="card" style="width: 18rem;">
    <?php
        echo '<img src="data:image/png;base64,' . base64_encode($imagem) . '" class="card-img-top" alt="Imagem">';
    ?>
    <a class="btn btn-outline-primary btn-sm" href="index.php?class=Zaap&acao=iniciar" role="button">verificar conexão</a>
    <a class="btn btn-outline-danger btn-sm" href="index.php?class=Zaap&acao=terminar" role="button">encerrar sessão</a>
  </div>
</div>