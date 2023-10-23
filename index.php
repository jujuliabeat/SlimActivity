<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;

$app->get('/', function (Request $request, Response $response, array $args) {

    $response->getBody()->write("API");

    return $response;
});

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'] ? $args['name'] : "visitante";
    $response->getBody()->write("Hello, $name");

    return $response->withStatus(404);
});

$app->get('/estudantes',function(Request $req, Response $resp, $params){

    $estudantes = [
        
        [
            'nome' => 'Julia',
            'nascimento' => '04-03-2005',
            'e-mail' => 'jb245573@gmail.com'
        ],
        
        [
            'nome' => 'Marcella',
            'nascimento' => '26-03-2006',
            'e-mail' => 'maarcelinha@gmail.com'
        ],
        
        [
            'nome' => 'Fernanda',
            'nascimento' => '03-02-2006',
            'e-mail' => 'fer@gmail.com'
        ],
        
        [
            'nome' => 'Geovana',
            'nascimento' => '30-11-2005',
            'e-mail' => 'geo@gmail.com'
        ]

    ];

    return $resp->withJson($estudantes);

});

$app->post('/estudantes', function(Request $req, Response $resp, $params){ 

    $estudanteCadastrado = $req->getParsedBody();


    //inserir no banco de dados 
    $resp->withStatus('201');

    return $resp->withJson($estudanteCadastrado);

});

$app->run();
