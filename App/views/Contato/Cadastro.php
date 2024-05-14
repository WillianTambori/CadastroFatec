

<!-- <div class="container text-center"> -->
  <div class="row">
    <div class="col-4">
    <div class="scrollable-box" style="max-height: 220px; overflow-y: auto;">
    <form action="index.php?class=Contato&acao=ContatosPorCadastro" method="POST">

    <ul class="list-group">
        <?php
        function NomeId($array,$id){
            foreach($array as $ar){
                if($ar["id"] === $id){
                    return $ar["curso"];
                }
            }
        }
        foreach($Cadastro as $cdt){?>
        <li class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
                <input class="form-check-input me-1" type="checkbox" name="param[0][]" value= <?= $cdt['id'] ?> >
                <h5 class="mb-1"><?=$cdt['id']." ".$cdt['Forma']?></h5>
                <small><?=$cdt['Data']?></small>
            </div>      
        </li>
            
        <?php }?>
        </ul>
    </div>
        <select class="form-select form-select-sm" aria-label="Small select example" name="param[1]">
        <option selected>Todos os cursos</option>
                <?php foreach($Curso as $ctt){
                    echo "<option value=".$ctt['id'] ." > ". $ctt['curso'] . "</option>";
                }?>
        </select>
        <div class="d-grid gap-2">
        <input type="submit" class="btn btn-outline-success" name="btnEnviar" value="Enviar">
        </div>
    </form>
    </div>
    <div class="col-8">
    <div class="scrollable-box" style="max-height: 300px; overflow-y: auto;">
        <ul class="list-group list-group-flush">
        <li class="list-group-item"> <strong>nome telefone email aceitaContato</strong></li>
            <?php
            for($i = 0;$i < count($contatos);$i++){?>
                <li class="list-group-item">
                    <?=
                    $contatos[$i]["nome"] ." ". 
                    $contatos[$i]["whatzaap"] ." ". 
                    $contatos[$i]["email"] ." ". 
                    NomeId($Curso,$contatos[$i]["Curso_id"]) ?>
                    <?php echo  $contatos[$i]["aceitaContato"]? "Sim" : "Não";
                    ?>
                </li>
            
            <?php } ?>
        </ul>
    </div>
    </div>
  </div>
<!-- </div> -->