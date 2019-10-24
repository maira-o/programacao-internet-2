<?php

class Cliente {

    public $id;
    public $nome;
    public $userEmail; 
    public $senha;
    public $whatsappNumber;

    function __construct($id, $nome, $userEmail, $whatsappNumber, $senha) {
        $this->id = $id;
        $this->nome = $nome;
        $this->userEmail = $userEmail;
        $this->whatsappNumber = $whatsappNumber;
        $this->senha = $senha;
    }
}

?>