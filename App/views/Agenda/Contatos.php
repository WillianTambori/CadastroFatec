<?php
function NomeIdCurso($array,$id){
    foreach($array as $ar){
        if($ar["id"] === $id){
            return $ar["curso"];
        }
    }
}





if(isset($contatos)){?>
    <div class="col">
        <div class="scrollable-box" style="max-height: 70vh; max-width: 70%; margin: 15px; overflow-y: auto;">
        <!-- <h1>Editar Agenda</h1>
        <form action=<?="index.php?class=Cadastro&acao=ListarCadastro&id=".$cadastro[0]['id']."&ex=1"?> method="post">
            <div class="row">
                
                    <input type="hidden" class="form-control" style="padding: 5px;"<?php echo isset($cadastro)?"value= ".$cadastro[0]['id']:" placeholder= '-----'" ?> name="id" id="id">
                
                <div class="col">
                    <input type="date" class="form-control" style="margin: 5px;" <?php echo isset($cadastro)?"value= ".$cadastro[0]['Data']:" placeholder= 'Data'" ?> name="Data" id="Data" required>
                </div>
                <div class="col">    
                    <input type="text" class="form-control" style="margin: 5px;" <?php echo isset($cadastro)?"value= ".$cadastro[0]['Forma']:" placeholder= 'Nome da agenda'" ?> name="Forma" id="Forma" required>
                </div>
                <div class="col" >    
                <select class="form-select" aria-label="Default select example" style="margin: 5px;" name='Responsavel_id' >
                    
                <?php echo 
                "<option selected value= ".$cadastro[0]['Responsavel_id']." >Quem é o preenchedor</option>";
                    foreach($Responsavel as $ctt){
                        echo "<option value=".$ctt['id'] ."  id='Responsavel_id' > ". $ctt['nome'] . "</option>";
                    }?>
                </select>
                </div>
                <div class="col">    
                    <input type="submit" class="btn btn-outline-success" style="margin: 5px;" name="<?php echo isset($cadastro)?"editar":"adicionar" ?>" required>
                </div>
            </div>
        </form> -->
        <h1>Contatos</h1>
        <a class="btn btn-outline-success" href="./index.php?class=Contato&acao=ListarContato&ag=<?= $cadastro[0]['id']?>">Editar</a>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Whatszaap</th>
                    <th scope="col">Email</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Contato</th>
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
                        </tr>
                    
                    <?php } ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }?>