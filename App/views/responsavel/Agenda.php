
<div style="width: 18rem;">
    <h1>Editar Agenda</h1>
    <form action=<?="index.php?class=Cadastro&acao=ListarCadastro&ag=".$_GET['id']?> method="post">
                    
                <input type="hidden" class="form-control" style="padding: 5px;"<?php echo isset($cadastro)?"value= ".$cadastro[0]['id']:" placeholder= '-----'" ?> name="id" id="id">
                <input type="hidden" class="form-control" style="padding: 5px;" value=<?= $_GET['id'] ?> name="Responsavel_id" id="id">
            
            <div class="col">
                <input type="date" class="form-control" style="margin: 5px;" <?php echo isset($cadastro)?"value= ".$cadastro[0]['Data']:" placeholder= 'Data'" ?> name="Data" id="Data" required>
            </div>
            <div class="col">    
                <input type="text" class="form-control" style="margin: 5px;" <?php echo isset($cadastro)?"value= ".$cadastro[0]['Forma']:" placeholder= 'Nome da agenda'" ?> name="Forma" id="Forma" required>
            </div>
            <div class="col">    
                <input type="submit" class="btn btn-outline-success" style="margin: 5px;" name="<?php echo isset($cadastro)?"editar":"adicionar" ?>" required>
            </div>
        
    </form>
</div>
       
<?php 

if(isset($Cadastro))foreach($Cadastro as $cdt){?>
<div class="card" style="width: 18rem; padding: 10px; padding:10px; margin: 10px;">
    <div class="card-body">
        <h5 class="card-title"><?= $cdt["Forma"] ?></h5>
        <h6 class="card-subtitle mb-2 text-body-secondary">Agenda criada em:</h6>
        <p class="card-text"><?= $cdt["Data"] ?>.</p>
        <button type="button" class="btn btn-warning">
            <a href='index.php?class=Cadastro&acao=ListarCadastro&id=<?php echo intval($cdt['id']) ?>&ex=1&ag=<?=$_GET['id']?>'>editar</a>
        </button>
        
        <button type="button" class="btn btn-warning">    
            <a href='index.php?class=Cadastro&acao=ListarCadastro&id=<?php echo intval($cdt['id']) ?>&ex=2&ag=<?=$_GET['id']?>'>excluir</a>
        </button>
    </div>
</div>

<?php }?>
