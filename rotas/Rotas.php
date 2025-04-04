<?php

class Rotas
{

    // Método inicializar todas as ROTAS (URLs) da aplicação
    public function executar()
    {

        $url = '/';


        // Verifica se a variavel esá definida n $_GET
        if (isset($_GET['url'])) {
            $url .= $_GET['url'];
        }

    //    var_dump($url);


        // Definir uma variavel para armazenar parametros
        $parametro = array();

        // Verifique se a URL não está vazia e não é só uma /
        if (!empty($url) && $url != '/') {


            // Controlador       (Controller)
            // Ação              (Método)
            // Informação Única  (Parametro)


            $url = explode('/', $url);

            // var_dump($url);

            array_shift($url); // Remover a primeira posição da ARRAY

            $controladorAtual = ucfirst($url[0]) . 'Controller';
            array_shift($url); 

            if(isset($url[0]) && !empty($url)){
                $acaoAtual = $url[0];
                //var_dump('Nome da ação atual: ' . $acaoAtual);
                array_shift($url);
            }else{
                $acaoAtual = 'index';
                
                // var_dump('Nome da ação atual: ' . $acaoAtual);
            }

            // Os parametros
            // count - Conta todos os elementos de um array ou de um objeto
            if(count($url) > 0){
                //var_dump(count($url));
                $parametro = $url;
            }
        }
        else
        {
            $controladorAtual = 'HomeController';
            $acaoAtual = 'index';
            //var_dump
        }
        // if (count($url) > 0){
        //     var_dump(count($url));
        //     $parametro = $url;
        // }
        //Verificar se o arquivo do CONTROLLER e a AÇÃO (metodo) existe
        // $acaoAtual = isset($url[1]) ? $url[1] : 'index';


        if(!file_exists('../app/controllers/'.$controladorAtual.'.php') || 
           !method_exists($controladorAtual, $acaoAtual)){
           
            var_dump('Não existe!' .$controladorAtual);
            var_dump('Não existe o metodo', $acaoAtual);

            //Se não existir definir o Controller e um Método padrão
            $controladorAtual = 'ErroController';
            $acaoAtual = 'index';

        }

        $contrller = new $controladorAtual();

        call_user_func_array(array($contrller, $acaoAtual), $parametro);

      

       


    
    }
}
