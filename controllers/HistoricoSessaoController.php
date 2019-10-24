<?php
require_once "./class/HistoricoSessao.php";
require_once "./dao/HistoricoSessaoDAO.php";

class HistoricoSessaoController {

    public function listar($req, $resp, $args) {
        $dao = new HistoricoSessaoDAO();
        $lista = $dao->listar();
        $resp = $resp->withJson($lista);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function buscarPorId($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new HistoricoSessaoDAO();
        $historico = $dao->buscarPorId($id);
        $resp = $resp->withJson($historico);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function inserir($req, $resp, $args) {
        $var = $req->getParsedBody();
        $historico = new HistoricoSessao(0, $var['numero'],$var['data'],$var['titulo'],$var['descricao']);
        $dao = new HistoricoSessaoDAO();
        $dao->inserir($historico);
        $resp = $resp->withJson($historico);
        $resp = $resp->withHeader("Content-type", "application/json");
        $resp = $resp->withStatus(201);
        return $resp;
    }

    public function atualizar($req, $resp, $args) {
        $id = (int) $args["id"];
        $var = $req->getParsedBody();
        $historico = new HistoricoSessao($id, $var['numero'],$var['data'],$var['titulo'],$var['descricao']);
        $dao = new HistoricoSessaoDAO();
        $dao->atualizar($historico);
        $resp = $resp->withJson($historico);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function deletar($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new HistoricoSessaoDAO();
        $historico = $dao->buscarPorId($id);
        $dao->deletar($id);
        $resp = $resp->withJson($historico);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }
}
?>