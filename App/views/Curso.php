<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body{
            width: 800px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h1>CRUD de Curso</h1>
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
        <input type="number" class="form-control" <?php echo $Responsavel_id ?> name="Responsavel_id" id="Responsavel_id" required>
    </div>
    <div class="col">    
        <input type="submit" class="btn btn-outline-success" name="<?php echo $enviar ?>" required>
    </div>
    </div>
    </form>

    
   
</body>
</html>