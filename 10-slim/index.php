<?php
    
    require __DIR__ . '/vendor/autoload.php';


    use Slim\Http\Request as Request;
    use Slim\Http\Response as Response;
    use Slim\App;
    use Slim\Container;

    $configuration = [
        'settings' => [
        'displayErrorDetails' => true,
        ],
    ];

    $container = new Container($configuration);
    $app = new App($container);

    $app->get('/{nome}', function (Request $request, Response $response, array $args) {

        $tratamento = ['Senhor','Senhora','Senhorita','Dom', 'Doutor', 'Excelentíssimo', 'Caro'];
        $qualidade  = ['o príncipe', 'o paladino', 'o guru'];
        $lugar      = ['das cataratas', 'do Paraná', 'do IFPR'];
        $nome       = $args['nome'];

        $frase = 'Olá '. $tratamento[rand(0, 6)] . " " . $nome;
        $frase .= ', ' . $qualidade[rand(0, 2)] . ' '. $lugar[rand(0, 2)];


        $response->getBody()->write($frase);
        return $response;
    });

    $app->run();


?>