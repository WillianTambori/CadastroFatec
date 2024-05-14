<div class="container text-center">
  <div class="row">
    <div class="col">
    <form action="index.php?class=Contato&acao=ContatosPorCadastro" method="POST">

    <ul class="list-group">
        <?php
        foreach($Cadastro as $cdt){?>
            <li class="list-group-item">
            <input class="form-check-input me-1" type="checkbox" name="param[]" value= <?= $cdt['id'] ?> >
            <label class="form-check-label">
            <?="cadastro dia: ". $cdt['Data']." id:" . $cdt['id'] ?>
            </li>
        </label>
            
        <?php }?>
        </ul>
        <input type="submit" name="btnEnviar" value="enviar">
    </form>
    </div>
    <div class="col-6">
        <ul class="list-group list-group-flush">
        <li class="list-group-item"> <strong>nome telefone email aceitaContato</strong></li>
            <?php
            for($i = 0;$i < count($contatos);$i++){?>
                <li class="list-group-item">
                    <?= 
                    $contatos[$i]["nome"] ." ". 
                    $contatos[$i]["whatzaap"] ." ". 
                    $contatos[$i]["email"] ." ". 
                    $contatos[$i]["aceitaContato"]
                    ?>
                </li>
            
            <?php } ?>
        </ul>
    </div>
  </div>
</div>