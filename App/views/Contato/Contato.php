<form action="index.php?class=Contato&acao=ListarContato" method="POST">
    <label class="form-check-label" style="padding: 10px; margin-left: 15px; width: 90%;" for="exampleCheck1">Escolha o filtro:</label>
    <select class="form-select form-select-sm" aria-label="Small select example" name="cs" style="padding: 10px; margin: 15px; width: 90%;">
        <option value="Todos" selected>Todos os Cursos</option>
        <?php foreach($Curso as $ctt){echo "
        <option value=".$ctt['id'] ." > ". $ctt['curso'] . "</option>";
        }
        echo $_POST['c']?>
    </select>
    <div class="d-grid gap-2" style="padding: 10px; margin: 10px;">
    <input type="submit" class="btn btn-outline-success" name="btnEnviar" value="Pesquisar">
    </div>
</form>
<?php if(isset($contatos)){ ?>
<div class="scrollable-box" style="max-height: 70vh; padding: 10px; margin: auto; overflow-y: auto;">
<form action="index.php?class=Contato&acao=ListarContato" method="POST">  
    <input type="hidden" class="btn btn-outline-success" name="cs" value="<?= $_POST['cs']?>">
    <input type="submit" class="btn btn-outline-success" name="PDF" value="PDF">
</form>

<!-- <a class="btn btn-outline-success"  href="./index.php?class=Contato&acao=ListarContato&pdf=1".<?= isset($_POST['cs'])? "&cs=".$_POST['cs']:"" ?>>PDF</a> -->
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Escola</th>
            <th scope="col">Whatszaap</th>
            <th scope="col">Contato</th>
            <th scope="col">Cadastro</th>
           
            
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($contatos as $ctt){?>
                <tr>
                <td scope="col"><?= $ctt['id']?></td>
                <td scope="col"><?= $ctt['nome']?></td>
                <td scope="col"><?= $ctt['email']?></td>
                <td scope="col"><?= $ctt['Escola']?></td>
                <td scope="col"><?= $ctt['whatzaap']?></td>
                <td scope="col"><?= $ctt['aceitaContato']?></td>
                <td scope="col"><?= $ctt['Cadastro_id']?></td>
                </tr>
            
            <?php } ?>
        </tbody>
    </table>
</div>
<?php }?>