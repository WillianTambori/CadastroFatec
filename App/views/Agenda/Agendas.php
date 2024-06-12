
<div class="scrollable-box" style="max-height: 70vh; padding:10px; overflow-y: auto;">
    <h1>Agendas</h1>
<?php
function NomeId($array,$id){
    foreach($array as $ar){
        if($ar["id"] === $id){
            return $ar["nome"];
        }
    }
}


foreach($Cadastro as $cdt){?>
<a href='index.php?class=Cadastro&acao=ListarCadastro&id=<?php echo intval($cdt['id']) ?>&ex=1'>
<div class="card" style="width: 18rem; padding: 10px; padding:10px; margin: 10px;">
  <div class="card-body">
    <h5 class="card-title"><?= $cdt["Forma"] ?></h5>
    <h6 class="card-subtitle mb-2 text-body-secondary"><?= NomeId($Responsavel,$cdt["Responsavel_id"]) ?></h6>
    <p class="card-text">Agenda criada em <?= $cdt["Data"] ?>.</p>
    
    
</div>
</div>
</a>

<?php }?>
</div>
