<?php
function NomeId($array,$id){
    foreach($array as $ar){
        if($ar["id"] === $id){
            return $ar["nome"];
        }
    }
}?>
<div style="width: 280px; padding: 10px">
<h1>Cursos</h1>
<form action="index.php?class=Curso&acao=ListarCurso&ag" method="post">
    <div class="row">
        <input type="text" class="form-control"<?php echo isset($Res)?"value= ".$Res[0]['id']:" placeholder= '-----'" ?>  name="id" id="id" hidden >
        <div class="col">
        <input type="text" class="form-control" <?php echo isset($Res)?"value= ".$Res[0]['curso']:" placeholder= curso" ?>  name="curso" id="nome" required>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="col">
            <input type="text" class="form-control" <?php echo isset($Res)?"value= ".$Res[0]['periodo']:" placeholder= preiodo" ?>  name="periodo" id="email" required>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="col">    
            <select class="form-select" aria-label="Default select example" name='Responsavel_id' id='Curso_id'>
                <option <?php echo isset($Res)?"value= ".$Res[0]['Responsavel_id']:"value=''" ?>  selected><?php echo isset($Res)? NomeId($Responsavel,$Res[0]["Responsavel_id"]):"Seleciona o coordenador" ?></option>
                <?php foreach($Responsavel as $ctt){
                    echo "<option value=".$ctt['id'] ." > ". $ctt['nome'] . "</option>";
                }?>
            </select>
        </div>
    </div>
    <div class="row" style="margin-top:10px;"> 
        <div class="col"> 
        <input type="submit" class="btn btn-outline-success" name="<?php echo isset($Res)?"editar":"adicionar" ?>" required>
        </div>
    </div>
    </div>
</form>
</div>
<div class="scrollable-box" style="max-height: 70vh; padding:10px; width: 60%; overflow-y: auto;">
<table class="table">
    <thead>
        <tr>
        <th scope="col">Curso</th>
        <th scope="col">Periodo</th>
        <th scope="col">Responsavel</th>
        <th scope="col">Opções</th>
        <th scope="col">Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        for($i = 0;$i < count($Cursos);$i++){?>
            <tr>
            <?=
                "<td>" . 
                $Cursos[$i]["curso"] ." </td><td>". 
                $Cursos[$i]["periodo"] ." </td><td>". 
                NomeId($Responsavel,$Cursos[$i]["Responsavel_id"])."</td>" 
                ?>
            <td>
            <button type="button" class="btn btn-warning">
            <a href='index.php?class=Curso&acao=ListarCurso&id=<?php echo $Cursos[$i]["id"] ?>&ex=1'>editar</a>
            </button>
            </td>
            <td>
            <button type="button" class="btn btn-warning">    
                <a href='index.php?class=Curso&acao=ListarCurso&id=<?php echo $Cursos[$i]["id"] ?>&ex=2'>excluir</a>
            </button>
            <td>
            </tr>
        
        <?php } ?>
    </tbody>
</table>
</div>