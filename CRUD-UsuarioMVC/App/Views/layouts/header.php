<?php
$nome_usuario = $_SESSION['usuario']['nome'];
$permissao_usuario = $_SESSION['usuario']['permissao'];
?>
<!DOCTYPE html>
<html lang="pt-br" class="h-100">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="http://<?php echo APP_HOST; ?>/public/css/bootstrap.min.css">
    <!-- Css para o navbar -->
    <link href="http://<?php echo APP_HOST; ?>/public/css/navbar.css" rel="stylesheet"> 
    <!-- Biblioteca de icones fontawesome-->
    <link href="http://<?php echo APP_HOST; ?>/public/fontawesome/css/all.css" rel="stylesheet"> 
    <title><?php echo TITLE; ?></title> 
  </head>
  <body class="d-flex flex-column h-100">
    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="http://<?php echo APP_HOST."/home/index" ?>">CRUD-ProdutoMVC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($viewVar['nameController'] == "HomeController") { ?> active <?php } ?>">
              <a class="nav-link" href="http://<?php echo APP_HOST .'/home/index' ?>">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if(($viewVar['nameController'] == "ProdutoController") AND ($viewVar['nameAction'] == "listar")){ ?> active <?php } ?>">
              <a class="nav-link" href="http://<?php echo APP_HOST.'/produto/listar'; ?>">Listar Produtos</a>
            </li>
            <li class="nav-item <?php if(($viewVar['nameController'] == "ProdutoController") AND ($viewVar['nameAction'] == "cadastrar")){ ?> active <?php } ?>">
                <a class="nav-link" href="http://<?php echo APP_HOST."/produto/cadastrar"; ?>">Cadastrar Produtos</a>
            </li>
            <ul class="navbar-nav" style="margin-right: 0px">
            <li class="nav-item dropdown" style="margin-right: 0px">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
              <span class="d-sm-inline">Usuarios</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" >
                
              <a class="dropdown-item <?php if($viewVar['nameController'] == "UsuarioController") { ?> active <?php } ?>"
                href="http://<?php echo APP_HOST."/usuario/cadastrar"; ?>">Cadastrar</a>
                
                <a class="dropdown-item <?php if(($viewVar['nameController'] == "UsuarioController") AND ($viewVar['nameAction'] == "listar")){ ?> active <?php } ?>"
                href="http://<?php echo APP_HOST."/usuario/listar"; ?>">Listar</a>
                
              </div>
            </li>
          </ul>
          </ul>

          <ul class="navbar-nav" style="margin-right: 0px">
            <li class="nav-item dropdown" style="margin-right: 0px">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
              <i class="fas fa-user"> </i> &nbsp;<span class="d-sm-inline"><?php echo $nome_usuario ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" >
                <a class="dropdown-item" href="#">Perfil</a>
                <a class="dropdown-item" href="#">Trocar Senha</a>
                <a class="dropdown-item" href="http://<?php echo APP_HOST.'/usuario/deslogar';?>">Sair</a>
              </div>
            </li>
          </ul>   
        </div>                
      </nav>
    </header>
