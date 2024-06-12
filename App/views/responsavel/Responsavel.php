<div class="scrollable-box" style="max-height: 65vh; max-width:350px; padding: 10px; margin: 10px;  overflow-y: auto;">

    <h1>Coordenadores</h1>
    <form action="index.php?class=Responsavel&acao=ListarResponsavel" method="post">
        
            <input type="hidden" class="form-control" <?php echo isset($Res)? "value= ".$Res[0]['id']: "placeholder='id'"?> name="id" id="id" hidden >
            <div class="col">
                <input type="text" class="form-control" <?php echo isset($Res)? "value= ".$Res[0]['nome']: "placeholder='nome'"?> name="nome" id="nome" required>
            </div>
            <div class="col">    
                <input type="text" class="form-control" <?php echo isset($Res)? "value= ".$Res[0]['telefone']: "placeholder='telefone'"?> name="telefone" id="telefone" required>
            </div>
            <div class="col">
                <input type="text" class="form-control" <?php echo isset($Res)? "value= ".$Res[0]['email']: "placeholder='email'"?> name="email" id="email" required>
            </div>
            <div class="col">    
            <input type="submit" class="btn btn-outline-success" name=<?php echo isset($Res)? "editar": "adicionar"?> value=<?php echo isset($Res)? "editar": "adicionar"?> required>
            </div>
        
    </form>

    <ol class="list-group list-group-numbered">
        <?php
        foreach($Responsavel as $cdt){?>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold"><?=$cdt['nome']?></div>
                <?="Telefone: ".$cdt['telefone']."<br> email: ". $cdt['email']?>
                <div>
                <button type="button" class="btn btn-outline-info btn-sm">
                    <a href='index.php?class=Responsavel&acao=ListarResponsavel&id=<?php echo $cdt['id'] ?>&ex=1'>editar</a>
                </button>

                <button type="button" class="btn btn-outline-info btn-sm">    
                    <a style="text-decoration: none;" href='index.php?class=Responsavel&acao=ListarResponsavel&id=<?php echo $cdt['id'] ?>&ex=2'>excluir</a>
                </button>
                </div>
            </div>      
            <span class="badge text-bg-primary rounded-pill"><?="id: ".$cdt['id']?></span>
            
        </li>
            
        <?php }?>
    </ol>
</div>


