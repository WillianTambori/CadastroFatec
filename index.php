<?php
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $_GET["class"]; ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="./App/views/style.css">
    </head>
        <body>
    <header>
        <section>

        </section>
        <section>
            <h1>Contatos</h1>
        </section>
    </header>
    <nav>
        <h3>
            <a class="nav-link <?php echo ($_GET['class']==='Cadastro'?"active":"") ?>" href="./index.php?class=Cadastro&acao=ListarCadastro">Cadastro</a>
        </h3>
        <h3>
            <a class="nav-link <?php echo ($_GET['acao']==='ListarContato'?"active":"") ?>" href="./index.php?class=Contato&acao=ListarContato">Contato</a>
        </h3>
        <h3>
            <a class="nav-link <?php echo ($_GET['class']==='Responsavel'?"active":"") ?>" href="index.php?class=Responsavel&acao=ListarResponsavel">Responsável</a>
        </h3>
        <h3>
            <a class="nav-link <?php echo ($_GET['class']==='Curso'?"active":"") ?>" href="index.php?class=Curso&acao=ListarCurso">Curso</a>
        </h3>
        <h3>
            <a class="nav-link <?php echo ($_GET['acao']==='conectar'?"active":"") ?>" href="index.php?class=Zaap&acao=iniciar">WhatsApp</a>
        </h3>
        <h3>
            <a class="nav-link <?php echo ($_GET['acao']==='conectar'?"active":"") ?>" href="index.php?class=Email&acao=enviar">Email</a>
        </h3>
    </nav>
    <article>
    <section class="temperatura">
        <?php
            ini_set("display_errors","On");


            require_once "vendor/autoload.php";
            //require_once "App/views/Navs.php";
            
            
            $classe = $_GET["class"];
            $metodo = $_GET["acao"];
            
            
            $classe = "App\\controllers\\" . $classe . "Controller";

            use App\Conexao\ConexaoBD;


            $bd = new ConexaoBD(DBHOST,DBNAME,DBUSER,DBPASS);
            
            $obj = new $classe($bd);

            if(isset($_POST["param"])){
                $param = $_POST["param"];
                if(isset($_FILES['arq'])){
                    $param =[];
                    array_push($param,$_POST["param"]);
                    array_push($param,$_FILES["arq"]);
                }

                $obj->$metodo($param);

            }else{

                $obj->$metodo();
            }

            
            
        ?>
        </section>
    </article>
        <footer>
            <p>Desenvolvido por Willian Diego Tambori msn.willian@gmail.com</p>
            <p>"Feliz é aquele que programa" </p>
            <p>Copyriight © 2024 - Todos os direitos reservados 2024</p>
        </footer>
        </body>
</html>

