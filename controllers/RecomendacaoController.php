<?php
require_once "./class/Recomendacao.php";
require_once "./dao/RecomendacaoDAO.php";

class RecomendacaoController {

    public function listar($req, $resp, $args) {
        $dao = new RecomendacaoDAO();
        $lista = $dao->listar();
        $resp = $resp->withJson($lista);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function buscarPorId($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new RecomendacaoDAO();
        $recomendacao = $dao->buscarPorId($id);
        $resp = $resp->withJson($recomendacao);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function inserir($req, $resp, $args) {
        $var = $req->getParsedBody();
        $recomendacao = new Recomendacao(0, $var['tipo'],$var['titulo'],$var['descricao']);
        $dao = new RecomendacaoDAO();
        $dao->inserir($recomendacao);
        $resp = $resp->withJson($recomendacao);
        $resp = $resp->withHeader("Content-type", "application/json");
        $resp = $resp->withStatus(201);
        return $resp;
    }

    public function atualizar($req, $resp, $args) {
        $id = (int) $args["id"];
        $var = $req->getParsedBody();
        $recomendacao = new Recomendacao($id, $var['tipo'],$var['titulo'],$var['descricao']);
        $dao = new RecomendacaoDAO();
        $dao->atualizar($recomendacao);
        $resp = $resp->withJson($recomendacao);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function deletar($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new RecomendacaoDAO();
        $recomendacao = $dao->buscarPorId($id);
        $dao->deletar($id);
        $resp = $resp->withJson($recomendacao);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }
}
?>