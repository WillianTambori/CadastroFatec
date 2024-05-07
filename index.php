<?php
    ini_set("display_errors","On");


    require_once "vendor/autoload.php";
    require_once "App/views/Navs.php";
    
    
    $classe = $_GET["class"];
    $metodo = $_GET["acao"];
    
    $classe = "App\\controllers\\" . $classe . "Controller";

    use App\Conexao\ConexaoBD;


    $bd = new ConexaoBD(DBHOST,DBNAME,DBUSER,DBPASS);
    
    $obj = new $classe($bd);

    $obj->$metodo();
    
    //$controlador->ExcluirFonecedorPorId($cod);

    
    
    
     
?>

