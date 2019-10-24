<?php

class Recomendacao {

    public $id;
    public $tipo;
    public $titulo;
    public $descricao;

    function __construct($id, $tipo, $titulo, $descricao) {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
    }
}

?>