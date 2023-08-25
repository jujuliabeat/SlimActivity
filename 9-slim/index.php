<?php
    
    require __DIR__."/vendor/autoload.php";

    use Slim\App as App;
    use Slim\Http\Request;
    use Slim\Http\Response;

    $app = new App();

    $app->get("/", function(Request $request, Response $response){

        $response -> getBody()->write("Bem Vindo Slim!");
        return $response;      
    });

    $app->get("/estudantes", function(Request $request, Response $response){

        $response -> getBody()->write("Bem Vindo estudantes!");
        return $response;      
    });

    $app->get("/estudantes/{nome}", function(Request $request, Response $response, $params){

        $nome = $params["nome"];
        $response -> getBody()->write("BEM VINDA ESTUDANTE: $nome!");
        return $response;      
    });
    
    $app->get("/curso/[{nome}]", function(Request $request, Response $response, $params){

        $nome = $params["nome"] ? $params["nome"] : "Sem nome";
        $response -> getBody()->write("Curso: $nome!");
        return $response;      
    });

    $app->get("/chocolates", function(Request $request, Response $response){

        $pais = $request->getQueryParam('pais', 'todos');


        $response -> getBody()->write("Chocolates do pais: $pais");
        return $response;      
    });


    $app->run();
?>