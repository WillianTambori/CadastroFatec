<div class="container px-4 text-center" style="padding: 20px"> 
    <div class="row ">

        <div class="col-4">
            <form action="index.php?class=Email&acao=enviar" method="POST">
                <div class="scrollable-box" style="max-height: 220px; overflow-y: auto;">

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
                    <?php foreach($Curso as $ctt){echo "
                    <option value=".$ctt['id'] ." > ". $ctt['curso'] . "</option>";
                    }?>
                </select>
                <div class="d-grid gap-2">
                    <input type="submit" class="btn btn-outline-success" name="btnEnviar" value="Pesquisar">
                </div>
            </form>
        </div>
        <div class="col-8">
            <div class="scrollable-box" style="max-height: 300px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">WhatsApp</th>
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
    <?php if(isset($emails)){?>
    <div class="col">   
        <div class="alert alert-success " role="alert">
        <p><?php echo isset($emails)?implode(',', $emails):""; ?></p>
        </div>
        <?php }?>
    
                    
     
        

