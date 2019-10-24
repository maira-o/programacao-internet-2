<?php
require_once "./class/Carta.php";
require_once "./dao/CartaDAO.php";

class CartaController {

    public function listar($req, $resp, $args) {
        $dao = new CartaDAO();
        $lista = $dao->listar();
        $resp = $resp->withJson($lista);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function buscarPorId($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new CartaDAO();
        $carta = $dao->buscarPorId($id);
        $resp = $resp->withJson($carta);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function inserir($req, $resp, $args) {
        $var = $req->getParsedBody();
        $carta = new Carta(0, $var['titulo'],$var['descricao']);
        $dao = new CartaDao();
        $dao->inserir($carta);
        $resp = $resp->withJson($carta);
        $resp = $resp->withHeader("Content-type", "application/json");
        $resp = $resp->withStatus(201);
        return $resp;
    }

    public function atualizar($req, $resp, $args) {
        $id = (int) $args["id"];
        $var = $req->getParsedBody();
        $carta = new Carta($id, $var['titulo'],$var['descricao']);
        $dao = new CartaDAO();
        $dao->atualizar($carta);
        $resp = $resp->withJson($carta);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function deletar($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new CartaDAO();
        $carta = $dao->buscarPorId($id);
        $dao->deletar($id);
        $resp = $resp->withJson($carta);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }
}
?>