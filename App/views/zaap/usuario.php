
<div class="card" style="width: 18rem; margin: 10px;">
  <div class="card-body">
    <h5 class="card-title">
    <?="nome: " .$usuario->sessionInfo->pushname;?>
    </h5>
    <h6 class="card-subtitle mb-2 text-body-secondary">
    <?="numero: " .$usuario->sessionInfo->wid->user;?>
    </h6>
    <p class="card-text">"bem vindo!!!".</p>
    <a class="btn btn-outline-danger btn-sm" href="index.php?class=Zaap&acao=terminar" role="button">encerrar sessão</a>
  </div>
</div>