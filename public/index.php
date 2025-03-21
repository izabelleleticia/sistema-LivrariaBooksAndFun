<?php


//Carregue as configurações iniciais
require_once('../config/config.php');



// Carregar a rota (URL da aplicação)
$nucleo = new Rotas();
$nucleo->executar();

