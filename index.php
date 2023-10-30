<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\App;


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

    $estudante = $req->getParsedBody();


    //Inserir no banco de dados 
    //$resp->withStatus('201');

    $estudante['id'] = rand(1, 1000);

    return $resp->withJson($estudante)->withStatus(201);

});

// Verbo Put é o verbo para atualização 
$app->put('/estudantes/{id}', function(Request $req, Response $resp, $params){ 

    try {

        $estudante = $req->getParsedBody();
    
    
        //Atualiza no banco de dados 
    
        $estudante['id'] = $params['id'];

        if($estudante['id'] == '99') {

            throw new Exception("Usuário não encontrado");

        }
    
        return $resp->withJson($estudante)->withStatus(200);

    } catch(Exception $e) {

        $erro = [

            'erro' => $e->getMessage(),
            'outras_infos' => "???"

        ];
            

        return $resp->withjson($erro)->withStatus(418);
        
    }

});

$app->delete('/estudantes/{id}', function(Request $req, Response $resp, $params){ 

    try {

        //Deletar no banco de dados 
    
        $estudante['id'] = $params['id'];

        if($estudante['id'] == '99') {

            throw new Exception("Usuário não encontrado");

        }
    
        return $resp->withStatus(204);

    } catch(Exception $e) {

        $erro = [

            'erro' => $e->getMessage(),
            'outras_infos' => "???"

        ];
            

        return $resp->withjson($erro)->withStatus(418);
        
    }

});



$app->run();
