<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once "db/PDOFactory.php";
require_once "controllers/ClienteController.php";
require_once "controllers/CartaController.php";
require_once "controllers/HistoricoSessaoController.php";
require_once "controllers/RecomendacaoController.php";
require "vendor/autoload.php";

// configuração do Slim para exibição dos detalhes na ocorrência de erros
$config = [
  'settings' => [
      'displayErrorDetails' => true 
  ],
];

// passar a variável $config como parâmetro da instância do Slim
$app = new \Slim\App($config);

// agrupamento para organizar o web service chamando os métodos do controller
$app->group("/clientes", 
  function () {
    $this->get("", "ClienteController:listar");
    $this->get("/{id:[0-9]+}", "ClienteController:buscarPorId");
    $this->post("", "ClienteController:inserir");
    $this->put("/{id:[0-9]+}", "ClienteController:atualizar");
    $this->delete("/{id:[0-9]+}", "ClienteController:deletar");
  }
);

$app->group("/cartas",
  function () {
    $this->get("", "CartaController:listar");
    $this->get("/{id:[0-9]+}", "CartaController:buscarPorId");
    $this->post("", "CartaController:inserir");
    $this->put("/{id:[0-9]+}", "CartaController:atualizar");
    $this->delete("/{id:[0-9]+}", "CartaController:deletar");
  }
); 

$app->group("/historicos",
  function () {
    $this->get("", "HistoricoSessaoController:listar");
    $this->get("/{id:[0-9]+}", "HistoricoSessaoController:buscarPorId");
    $this->post("", "HistoricoSessaoController:inserir");
    $this->put("/{id:[0-9]+}", "HistoricoSessaoController:atualizar");
    $this->delete("/{id:[0-9]+}", "HistoricoSessaoController:deletar");
  }
); 

$app->group("/recomendacoes",
  function () {
    $this->get("", "RecomendacaoController:listar");
    $this->get("/{id:[0-9]+}", "RecomendacaoController:buscarPorId");
    $this->post("", "RecomendacaoController:inserir");
    $this->put("/{id:[0-9]+}", "RecomendacaoController:atualizar");
    $this->delete("/{id:[0-9]+}", "RecomendacaoController:deletar");
  }
); 

$app->run();
?>
