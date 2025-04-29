<!DOCTYPE html> <!--Tag para identificar o HTML5-->
<html lang="pt-br"> <!--Linguagem da página-->

<head>
    <meta charset="UTF-8"> <!--Padronização da língua-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Autoriza a codificação para responsividade-->
    <!-- <link rel="shortcut icon" href="img/logo_077.png" type="image/x-icon"> -->
    <title><?php echo $dados['titulo_pagina']?></title> <!--Titulo da Guia-->
    <!--RESET SEMPRE O PRIMEIRO LINK-->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/reset.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/estilo.css">
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/slick.css" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/slick-theme.css" />
<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/lity.css">

</head>

<body>
    <header>
        <?php require_once('template/menu.php'); ?>
    </header>
    <main>
        <?php require_once('template/livro.php'); ?>
    </main>
    
    <footer>
        <?php require_once('template/rodape.php'); ?>
    </footer>
</body>
<!--JQUERY obrigatório para animação-->
<script type="text/javascript" src="//code.jquery.com/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-3.5.0.min.js"></script>
<!--Animação CARROSSEL Slick-->
<script type="text/javascript" src="js/slick.min.js"></script>
<script src="js/lity.js"></script>
<!--Minha animação sempre por último-->
<script type="text/javascript" src="js/js.animation.js"></script>
</body>

</html>