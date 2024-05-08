    <?php
    $codigo = " placeholder= '-----'";
    $curso= "placeholder= 'curso'";
    $periodo = "placeholder='periodo do Curso'";
    $Responsavel_id = "placeholder= 'coordenador'";
    $enviar =  "adicionar";
    $formulario = "Cadastrar" ;
    if(isset($_GET["id"]) && is_numeric($_GET["id"]) && isset($_GET["ex"])){
        $cod = $_GET["id"];
        $ex = $_GET["ex"];

        if($ex == 1 ){
            $formulario ="Editar Curso";
            foreach($this->CursoModelo->obterCursoPorId($cod) as $cdt){
                $codigo= "value= ". $cdt['id'];
                $curso = "value= ". $cdt['curso'];
                $periodo = "value= ". $cdt['periodo'];
                $Responsavel_id = "value= ". $cdt['Responsavel_id'];
                $enviar =  "editar";
                
            }
        }
        if($ex == 2 ){
            $this->ExcluirCursoPorId($cod);
            header('location:./index.php?class=Curso&acao=ListarCurso');
            
        }
    }
    if(isset($_POST['adicionar'])) {
        $curso = $_POST['curso'];
        $periodo = $_POST['periodo'];
        $Responsavel_id = $_POST['Responsavel_id'];

        $this->AdicionarCurso($curso,$periodo,$Responsavel_id);
        header('location:./index.php?class=Curso&acao=ListarCurso');
        
    }

    if(isset($_POST['editar'])) {
        $codigo= $_POST['id'];
        $curso = $_POST['curso'];
        $periodo = $_POST['periodo'];
        $Responsavel_id = $_POST['Responsavel_id'];

        $this->AlterarCurso($codigo,$curso,$periodo,$Responsavel_id);
        header('location:./index.php?class=Curso&acao=ListarCurso');
        
    }
    ?>
    <ul>
        <?php
        if(isset($_GET['id'])){
            $cod = $_GET["id"];
        }
        foreach($this->CursoModelo->obterCurso() as $cdt){?>
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item"><?php echo $cdt['id'] ?></li>
            <li class="list-group-item"><?php echo $cdt['curso'] ?></li>
            <li class="list-group-item"><?php echo $cdt['periodo'] ?></li>
            <li class="list-group-item"><?php echo $cdt['Responsavel_id'] ?></li>
            <button type="button" class="btn btn-warning">
                <a href='index.php?class=Curso&acao=ListarCurso&id=<?php echo $cdt['id'] ?>&ex=1'>editar</a>
            </button>

            <button type="button" class="btn btn-warning">    
                <a href='index.php?class=Curso&acao=ListarCurso&id=<?php echo $cdt['id'] ?>&ex=2'>excluir</a>
            </button>
        </ul>
        
        <?php
        
        }
        ?>
        
    </ul>
    <h1><?php echo $formulario ?></h1>
    <form action="index.php?class=Curso&acao=ListarCurso" method="post">
    <div class="row">
    <div class="col">
        <input type="hidden" class="form-control" <?php echo $codigo ?> name="id" id="id" required>
    </div>
    <div class="col">
        <input type="text" class="form-control" <?php echo $curso ?> name="curso" id="curso" required>
    </div>
    <div class="col">    
        <input type="text" class="form-control" <?php echo $periodo ?> name="periodo" id="periodo" required>
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

    
   
