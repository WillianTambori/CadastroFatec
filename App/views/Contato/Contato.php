
    <?php
    $Cadastro_id = "placeholder='id cadastro'";
    $codigo= " placeholder= '-----'";
    $nome = "placeholder='nome'";
    $whatzaap = "placeholder= 'whatzaap'";
    $Escola="placeholder= 'Escola'";
    $email = "placeholder= 'email' ";
    $aceitaContato = "value= '1' required checked";
    $enviar =  "adicionar";
    $formulario = "Cadastrar" ;
    $Curso_id = "Selecione um curso";

    function NomeId($array,$id){
        foreach($array as $ar){
            if($ar["id"] === $id){
                return $ar["curso"];
            }
        }
    }



    if(isset($_GET["id"]) && is_numeric($_GET["id"]) && isset($_GET["ex"])){
        $cod = $_GET["id"];
        $ex = $_GET["ex"];

        if($ex == 1 ){
            $formulario ="Editar Cadastro";
            foreach($this->ContatoModelo->obterContatoPorId($cod) as $ctt){
                $codigo= "value= ". $ctt['id'];
                $nome = "value= ". $ctt['nome'];
                $whatzaap = "value= ". $ctt['whatzaap'];
                $email = "value= ". $ctt['email'];
                $Escola = "value= ". $ctt['Escola'];
                $aceitaContato = "value= ". $ctt['aceitaContato'];
                $Cadastro_id = "value= ".$ctt["Cadastro_id"] ;
                $Curso_id = "value= ". $ctt["Curso_id"];
                $enviar =  "editar";
                
            }
        }
        if($ex == 2 ){
            $this->ExcluirContatoPorId($cod);
            header('location:./index.php?class=Contato&acao=ListarContato');
            
        }
    }
    if(isset($_POST['adicionar'])) {
        $nome = $_POST["nome"];
        $whatzaap = $_POST["whatzaap"];
        $email = $_POST["email"];
        $Escola = $_POST["Escola"];
        $Cadastro_id = $_POST["Cadastro_id"];
        $Curso_id = $_POST["Curso_id"];
        $aceitaContato = $_POST["aceitaContato"];

        $this->AdicionarContato($nome, $email, $Escola, $whatzaap, $aceitaContato, $Cadastro_id, $Curso_id);
        header('location:./index.php?class=Contato&acao=ListarContato');
    
    }

    if(isset($_POST['editar'])) {
        $codigo = $_POST["id"];
        $nome = $_POST["nome"];
        $whatzaap = $_POST["whatzaap"];
        $email = $_POST["email"];
        $Escola = $_POST["Escola"];
        $Cadastro_id = $_POST["Cadastro_id"];
        $Curso_id = $_POST["Curso_id"];
        isset($_POST["aceitaContato"])?$aceitaContato =1:$aceitaContato =0;

        $this->AlterarContato($codigo, $nome, $email, $Escola, $whatzaap, $aceitaContato, $Cadastro_id,$Curso_id);
        header('location:./index.php?class=Contato&acao=ListarContato');
    
    }
    ?>
<ul>
    <?php
    if(isset($_GET['id'])){
        $cod = $_GET["id"];
    }
    foreach($this->ContatoModelo->obterContato() as $ctt){?>
    <ul class="list-group list-group-horizontal">
        <li class="list-group-item"><?php echo $ctt['nome'] ?></li>
        <li class="list-group-item"><?php echo $ctt['email'] ?></li>
        <li class="list-group-item"><?php echo $ctt['Escola'] ?></li>
        <li class="list-group-item"><?php echo $ctt['whatzaap'] ?></li>
        <li class="list-group-item"><?php echo Nomeid($Curso,$ctt['Curso_id']) ?></li>
        <li class="list-group-item"> <?php echo $ctt['aceitaContato']? "Sim" : "Não"; ?></li>
        <button type="button" class="btn btn-warning">
            <a href='index.php?class=Contato&acao=ListarContato&id=<?php echo $ctt['id'] ?>&ex=1'>editar</a>
        </button>

        <button type="button" class="btn btn-warning">    
            <a href='index.php?class=Contato&acao=ListarContato&id=<?php echo $ctt['id'] ?>&ex=2'>excluir</a>
        </button>
    </ul>
    
    <?php
    }
    ?>
</ul>
<h1><?php echo $formulario ?></h1>
<form action="index.php?class=Contato&acao=ListarContato" method="post">
    <div class="row">
        <input type="text" class="form-control" <?php echo $codigo ?> name="id" id="id" hidden >
        <div class="col">
        <input type="text" class="form-control" <?php echo $Cadastro_id ?> name="Cadastro_id" id="Cadastro_id" required >
        </div>
        <div class="col">
            <input type="text" class="form-control" <?php echo $nome ?> name="nome" id="nome" required>
        </div>
        <div class="col">    
            <input type="text" class="form-control" <?php echo $whatzaap ?> name="whatzaap" id="whatzaap" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <input type="text" class="form-control" <?php echo $email ?> name="email" id="email" required>
        </div>
        <div class="col">    
            <input type="text" class="form-control" <?php echo $Escola ?> name="Escola" id="Escola" required>
        </div>
        <div class="col">    
            <select class="form-select" aria-label="Default select example" name='Curso_id' id='Curso_id'>
                <option <?php echo $Curso_id ?> selected>escolha um curso</option>
                <?php foreach($Curso as $ctt){
                    echo "<option value=".$ctt['id'] ." > ". $ctt['curso'] . "</option>";
                }?>
        </select>
            </div>
        <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" <?php echo $aceitaContato ?> name="aceitaContato" id="aceitaContato"> >
        <!-- <input type="hidden" value="0" name="aceitaContato" id="aceitaContato"> -->
        <label class="form-check-label" for="exampleCheck1">você concorda em receber informações sobre FATEC?</label>
        </div>
        <input type="submit" class="btn btn-outline-success" name="<?php echo $enviar ?>" required>
    </div>
</form>