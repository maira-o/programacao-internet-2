<?php
require_once "./class/Cliente.php";
require_once "./dao/ClienteDAO.php";

class ClienteController {

    public function listar($req, $resp, $args) {
        $dao = new ClienteDAO();
        $lista = $dao->listar();
        $resp = $resp->withJson($lista);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function buscarPorId($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new ClienteDAO();
        $cliente = $dao->buscarPorId($id);
        $resp = $resp->withJson($cliente);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function inserir($req, $resp, $args) {
        $var = $req->getParsedBody();
        $cliente = new Cliente(0, $var['nome'],$var['userEmail'],$var['senha'],$var['whatsappNumber']);
        $dao = new ClienteDAO();
        $dao->inserir($cliente);
        $resp = $resp->withJson($cliente);
        $resp = $resp->withHeader("Content-type", "application/json");
        $resp = $resp->withStatus(201);
        return $resp;
    }

    public function atualizar($req, $resp, $args) {
        $id = (int) $args["id"];
        $var = $req->getParsedBody();
        $cliente = new Cliente($id, $var['nome'],$var['userEmail'],$var['senha'],$var['whatsappNumber']);
        $dao = new ClienteDAO();
        $dao->atualizar($cliente);
        $resp = $resp->withJson($cliente);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function deletar($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new ClienteDAO();
        $cliente = $dao->buscarPorId($id);
        $dao->deletar($id);
        $resp = $resp->withJson($cliente);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }
}
?>