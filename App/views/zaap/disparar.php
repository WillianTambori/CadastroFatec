 <div class="container"> 
    <div class="row ">

        <div class="col">
            <form action="index.php?class=Zaap&acao=iniciar" method="POST">
                <div class="scrollable-box" style="max-height: 220px; padding: 10px; margin: 10px;  overflow-y: auto;">

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
                <select class="form-select form-select-sm" aria-label="Small select example" name="param[1]" style="padding: 10px; margin: 15px; width: 90%;">
                    <option selected>Todos os cursos</option>
                    <?php foreach($Curso as $ctt){echo "
                    <option value=".$ctt['id'] ." > ". $ctt['curso'] . "</option>";
                    }?>
                </select>
                <div class="d-grid gap-2" style="padding: 10px; margin: 10px;">
                    <input type="submit" class="btn btn-outline-success" name="btnEnviar" value="Pesquisar">
                </div>
            </form>
        </div>
        <div class="col-8">
            <div class="scrollable-box" style="max-height: 300px; padding: 10px; margin: 10px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Whatszaap</th>
                        <th scope="col">Email</th>
                        <th scope="col">Escola</th>
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
                                    $contatos[$i]["Escola"]."</td><td>" 
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
    <div class="row" style="padding: 10px; margin: 10px;">
    <?php
        if(isset($telefones)){   ?>                 
        <form action="index.php?class=Zaap&acao=dispararMsn" method="post">
        <div class="input-group mb-3">
                <input type="hidden" name="param[0]" value=<?php echo json_encode($telefones); ?>>
                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="mensagem" rows="2" name="param[1]"></textarea>
                <button class="btn btn-outline-success" type="submit" id="button-addon2">Enviar mensagem</button>
        </div>
        </form>
        <form action="index.php?class=Zaap&acao=dispararUrl" method="post">
                
                <div class="input-group mb-3">
                    <input type="hidden" name="param[0]" value=<?php echo json_encode($telefones); ?>>
                    <input type="text" class="form-control" placeholder="Url de imagem" aria-label="Recipient's username" aria-describedby="button-addon2" name="param[1]" >
                    <button class="btn btn-outline-success" type="submit" id="button-addon2">Enviar imagem</button>
                </div>
            
        </form>
        <form action="index.php?class=Zaap&acao=dispararMidia" method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
                    <input type="hidden" name="param" value=<?php echo json_encode($telefones); ?>>
                    <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="arq">
                    <button class="btn btn-outline-success" type="submit" id="inputGroupFileAddon04">Enviar documento</button>
                </div>
        </form>
    </div>
<?php }?>
    <div class="row ">
        <?php
        if(isset($tel)){
            for($i = 0; $i < count($tel);$i++){?>

            <div class="col">   
                
                <div class="alert alert-<?php echo $tel[$i]["resultado"]?"success ": "danger "; ?>" role="alert">
                <?= $tel[$i]["resultado"]?"envio a ".$tel[$i]["numero"]." com sucesso":"envio a ".$tel[$i]["numero"]." falhado"; ?>
                </div>
            </div>
            <?php
            }
        }
        
        ?>
        </div>
</div> 
