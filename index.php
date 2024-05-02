<?php
    ini_set("display_errors","On");

    include "views/Navs.php";
    require_once "Config.php";
    
    $classe = $_GET["class"];
    $metodo = $_GET["acao"];
    
    $classe .= 'Controller';

    require_once 'controllers/'.$classe.'.php';
    require_once "ConexaoBD.php";
    $bd = new ConexaoBD(DBHOST,DBNAME,DBUSER,DBPASS);
    
    $obj = new $classe($bd);

    $obj->$metodo();
    
    //$controlador->ExcluirFonecedorPorId($cod);

    
    
    
     
?>

