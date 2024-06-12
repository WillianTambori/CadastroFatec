<?php
function NomeIdCurso($array,$id){
    foreach($array as $ar){
        if($ar["id"] === $id){
            return $ar["curso"];
        }
    }
}?>
<div style="width: 280px; padding: 10px">
<form action="index.php?class=Contato&acao=ListarContato&ag=<?= $_GET['ag']?>" method="post">
    <div class="row">
        <input type="text" class="form-control"<?php echo isset($cadastro)?"value= ".$cadastro[0]['id']:" placeholder= '-----'" ?>  name="id" id="id" hidden >
        <input type="hidden" class="form-control" <?php echo "value=".$_GET['ag'] ?> name="Cadastro_id" id="Cadastro_id" required >
        <div class="col">
            <input type="text" class="form-control" <?php echo isset($cadastro)?"value= ".$cadastro[0]['nome']:" placeholder= nome" ?>  name="nome" id="nome" required>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="col">
            <input type="text" class="form-control" <?php echo isset($cadastro)?"value= ".$cadastro[0]['email']:" placeholder= email" ?>  name="email" id="email" required>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="col">    
            <input type="text" class="form-control" <?php echo isset($cadastro)?"value= ".$cadastro[0]['whatzaap']:" placeholder= whtazaap" ?>  name="whatzaap" id="whatzaap" required>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="col">    
            <input type="text" class="form-control" <?php echo isset($cadastro)?"value= ".$cadastro[0]['Escola']:" placeholder= escola" ?>  name="Escola" id="Escola" required>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="col">    
            <select class="form-select" aria-label="Default select example" name='Curso_id' id='Curso_id'>
                <option <?php echo isset($cadastro)?"value= ".$cadastro[0]['Curso_id']:"value=''" ?>  selected><?php echo isset($cadastro)? NomeIdCurso($Curso,$cadastro[0]["Curso_id"]):"Seleciona o curso" ?></option>
                <?php foreach($Curso as $ctt){
                    echo "<option value=".$ctt['id'] ." > ". $ctt['curso'] . "</option>";
                }?>
            </select>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="col">
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" <?php if(isset($cadastro)){ echo $cadastro[0]['aceitaContato'] === 1? "value='1' checked":"value='0'";}else{echo "value='1' required checked";}?> name="aceitaContato" id="aceitaContato"> >
            <!-- <input type="hidden" value="0" name="aceitaContato" id="aceitaContato"> -->
            <label class="form-check-label" for="exampleCheck1">autoriza contato?</label>
        </div>
        </div>
    </div>
        <div class="row" style="margin-top:10px;"> 
            <div class="col"> 
            <input type="submit" class="btn btn-outline-success" name="<?php echo isset($cadastro)?"editar":"adicionar" ?>" required>
            </div>
        </div>
    </div>
</form>
</div>
<div class="scrollable-box" style="max-height: 70vh; padding:10px; width: 60%; overflow-y: auto;">
<table class="table">
    <thead>
        <tr>
        <th scope="col">Nome</th>
        <th scope="col">Whatszaap</th>
        <th scope="col">Email</th>
        <th scope="col">Curso</th>
        <th scope="col">Contato</th>
        <th scope="col" >Opções</th>
        <th scope="col" >Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        for($i = 0;$i < count($contatos);$i++){?>
            <tr>
            <?=
                "<td>" . 
                $contatos[$i]["nome"] ." </td><td>". 
                $contatos[$i]["whatzaap"] ." </td><td>". 
                $contatos[$i]["email"] ." </td><td>". 
                NomeIdCurso($Curso,$contatos[$i]["Curso_id"])."</td><td>" 
                ?><?php 
                echo  $contatos[$i]["aceitaContato"]? "Sim </td>" : "Não </td>";
            ?>
            <td>
            <button type="button" class="btn btn-warning">
            <a href='index.php?class=Contato&acao=ListarContato&ag=<?= $_GET['ag']?>&id=<?php echo $contatos[$i]["id"] ?>&ex=1'>editar</a>
            </button>
            </td>
            <td>
            <button type="button" class="btn btn-warning">    
                <a href='index.php?class=Contato&acao=ListarContato&ag=<?= $_GET['ag']?>&id=<?php echo $contatos[$i]["id"] ?>&ex=2'>excluir</a>
            </button>
            <td>
            </tr>
        
        <?php } ?>
    </tbody>
</table>
</div>