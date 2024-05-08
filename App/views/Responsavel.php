    <?php
    $nome = "placeholder='nome'";
    $codigo= " placeholder= '-----'";
    $telefone = "placeholder='telefone'";
    $email = "placeholder= 'email' ";
    $enviar =  "adicionar";
    $formulario = "Cadastrar" ;
    if(isset($_GET["id"]) && is_numeric($_GET["id"]) && isset($_GET["ex"])){
        $cod = $_GET["id"];
        $ex = $_GET["ex"];

        if($ex == 1 ){
            $formulario ="Editar Responsavel";
            foreach($this->ResponsavelModelo->obterResponsavelPorId($cod) as $ctt){
                $codigo= "value= ". $ctt['id'];
                $nome = "value= ". $ctt['nome'];
                $telefone = "value= ". $ctt['telefone'];
                $email = "value= ". $ctt['email'];
                $enviar =  "editar";
                
            }
        }
        if($ex == 2 ){
            $this->ExcluirResponsavelPorId($cod);
            header('location:./index.php?class=Responsavel&acao=ListarResponsavel');
            
        }
    }
    if(isset($_POST['adicionar'])) {
        $nome = $_POST["nome"];
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];

        $this->AdicionarResponsavel($nome, $telefone, $email);
        header('location:./index.php?class=Responsavel&acao=ListarResponsavel');
    
    }

    if(isset($_POST['editar'])) {
        $codigo = $_POST["id"];
        $nome = $_POST["nome"];
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];

        $this->AlterarResponsavel($codigo, $nome, $telefone, $email);
        header('location:./index.php?class=Responsavel&acao=ListarResponsavel');
    
    }
    ?>
<ul>
    <?php
    if(isset($_GET['id'])){
        $cod = $_GET["id"];
    }
    foreach($this->ResponsavelModelo->obterResponsavel() as $ctt){?>
    <ul class="list-group list-group-horizontal">
        <li class="list-group-item"><?php echo $ctt['nome'] ?></li>
        <li class="list-group-item"><?php echo $ctt['email'] ?></li>
        <li class="list-group-item"><?php echo $ctt['telefone'] ?></li>
        <button type="button" class="btn btn-warning">
            <a href='index.php?class=Responsavel&acao=ListarResponsavel&id=<?php echo $ctt['id'] ?>&ex=1'>editar</a>
        </button>

        <button type="button" class="btn btn-warning">    
            <a href='index.php?class=Responsavel&acao=ListarResponsavel&id=<?php echo $ctt['id'] ?>&ex=2'>excluir</a>
        </button>
    </ul>
    
    <?php
    }
    ?>
</ul>
<h1><?php echo $formulario ?></h1>
<form action="index.php?class=Responsavel&acao=ListarResponsavel" method="post">
    <div class="row">
        <input type="text" class="form-control" <?php echo $codigo ?> name="id" id="id" hidden >
        <div class="col">
            <input type="text" class="form-control" <?php echo $nome ?> name="nome" id="nome" required>
        </div>
        <div class="col">    
            <input type="text" class="form-control" <?php echo $telefone ?> name="telefone" id="telefone" required>
        </div>
        <div class="col">
            <input type="text" class="form-control" <?php echo $email ?> name="email" id="email" required>
        </div>
        <div class="col">    
        <input type="submit" class="btn btn-outline-success" name="<?php echo $enviar ?>" required>
        </div>
    </div>
</form>

