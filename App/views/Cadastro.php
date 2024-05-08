    <?php
    $codigo = " placeholder= '-----'";
    $Data= "placeholder= 'data'";
    $Forma = "placeholder='Forma de Cadastro'";
    $Responsavel_id = "placeholder= 'preenchedor'";
    $enviar =  "adicionar";
    $formulario = "Cadastrar" ;

    function NomeId($array,$id){
        foreach($array as $ar){
            if($ar["id"] === $id){
                return $ar["nome"];
            }
        }
    }


    if(isset($_GET["id"]) && is_numeric($_GET["id"]) && isset($_GET["ex"])){
        $cod = $_GET["id"];
        $ex = $_GET["ex"];

        if($ex == 1 ){
            $formulario ="Editar Cadastro";
            foreach($this->CadastroModelo->obterCadastroPorId($cod) as $cdt){
                $codigo= "value= ". $cdt['id'];
                $Data = "value= ". $cdt['Data'];
                $Forma = "value= ". $cdt['Forma'];
                $Responsavel_id = "value= ". $cdt['Responsavel_id'];
                $enviar =  "editar";
                
            }
        }
        if($ex == 2 ){
            $this->ExcluirCadastroPorId($cod);
            header('location:./index.php?class=Cadastro&acao=ListarCadastro');
            
        }
    }
    if(isset($_POST['adicionar'])) {
        $Data = $_POST['Data'];
        $Forma = $_POST['Forma'];
        $Responsavel_id = $_POST['Responsavel_id'];

        $this->AdicionarCadastro($Data,$Forma,$Responsavel_id);
        header('location:./index.php?class=Cadastro&acao=ListarCadastro');
        
    }

    if(isset($_POST['editar'])) {
        $codigo= $_POST['id'];
        $Data = $_POST['Data'];
        $Forma = $_POST['Forma'];
        $Responsavel_id = $_POST['Responsavel_id'];

        $this->AlterarCadastro($codigo,$Data,$Forma,$Responsavel_id);
        header('location:./index.php?class=Cadastro&acao=ListarCadastro');
        
    }
    ?>
    <ul>
        <?php
        if(isset($_GET['id'])){
            $cod = $_GET["id"];
        }
        foreach($this->CadastroModelo->obterCadastro() as $cdt){?>
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item"><?php echo $cdt['id'] ?></li>
            <li class="list-group-item"><?php echo $cdt['Data'] ?></li>
            <li class="list-group-item"><?php echo $cdt['Forma'] ?></li>
            <li class="list-group-item"><?php echo NomeId($Responsavel,$cdt['Responsavel_id']) ?></li>
            <button type="button" class="btn btn-warning">
                <a href='index.php?class=Cadastro&acao=ListarCadastro&id=<?php echo $cdt['id'] ?>&ex=1'>editar</a>
            </button>

            <button type="button" class="btn btn-warning">    
                <a href='index.php?class=Cadastro&acao=ListarCadastro&id=<?php echo $cdt['id'] ?>&ex=2'>excluir</a>
            </button>
        </ul>
        
        <?php
        
        }
        ?>
        
    </ul>
    <h1><?php echo $formulario ?></h1>
    <form action="index.php?class=Cadastro&acao=ListarCadastro" method="post">
    <div class="row">
    <div class="col">
        <input type="hidden" class="form-control" <?php echo $codigo ?> name="id" id="id" required>
    </div>
    <div class="col">
        <input type="date" class="form-control" <?php echo $Data ?> name="Data" id="Data" required>
    </div>
    <div class="col">    
        <input type="text" class="form-control" <?php echo $Forma ?> name="Forma" id="Forma" required>
    </div>
    <div class="col">    
    <select class="form-select" aria-label="Default select example" name='Responsavel_id' >
        <option selected>Quem é o preenchedor</option>
        <?php foreach($Responsavel as $ctt){
            echo "<option value=".$ctt['id'] ."  id='Responsavel_id' > ". $ctt['nome'] . "</option>";
        }?>
    </select>
    </div>
    <div class="col">    
        <input type="submit" class="btn btn-outline-success" name="<?php echo $enviar ?>" required>
    </div>
    </div>
    </form>

