<?php

class Carta {

    public $id;
    public $titulo;
    public $descricao;

    function __construct($id, $titulo, $descricao) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
    }
}

?>