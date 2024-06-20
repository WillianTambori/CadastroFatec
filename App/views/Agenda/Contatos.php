<?php if(isset($contatos)){?>
    <div class="col">
        <div class="scrollable-box" style="max-height: 70vh; max-width: 70%; margin: 15px; overflow-y: auto;">
        <h1>Contatos</h1>
        <a class="btn btn-outline-success" href="./index.php?class=Contato&acao=ListarContato&ag=<?= $cadastro[0]['id']?>">Editar</a>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Whatszaap</th>
                    <th scope="col">Email</th>
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
                            $contatos[$i]["email"] ." </td><td>"
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