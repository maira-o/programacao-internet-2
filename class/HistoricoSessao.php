<?php

class HistoricoSessao {

    public $id;
    public $numero;
    public $data; 
    public $titulo;
    public $descricao;

    function __construct($id, $numero, $data, $titulo, $descricao) {
        $this->id = $id;
        $this->numero = $numero;
        $this->data = $data;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
    }
}

?>