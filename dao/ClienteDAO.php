<?php
	include_once "./class/Cliente.php";
	include_once "./db/PDOFactory.php";

	class ClienteDAO {

		public function listar() {
			$query = "SELECT * FROM cliente";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$clientes = array();	
			while($row = $comando->fetch(PDO::FETCH_OBJ)) {
				$clientes[] = new Cliente($row->id,$row->nome,$row->userEmail,$row->whatsappNumber,$row->senha);
			}
			return $clientes;
		}

		public function buscarPorId($id) {
			$query = "SELECT * FROM cliente WHERE id = :id";		
			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("id", $id);
			$comando->execute();
			$resultado = $comando->fetch(PDO::FETCH_OBJ);
			return new Cliente($resultado->id, $resultado->nome, $resultado->userEmail, $resultado->whatsappNumber, $resultado->senha);           
		}

		public function inserir(Cliente $cliente) {
			$query = "INSERT INTO cliente(nome, userEmail, senha, whatsappNumber) VALUES (:nome, :userEmail, :senha, :whatsappNumber)";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":nome", $cliente->nome);
            $comando->bindParam(":userEmail", $cliente->userEmail);
			$comando->bindParam(":senha", $cliente->senha);
			$comando->bindParam(":whatsappNumber", $cliente->whatsappNumber);
			$comando->execute();
			$cliente->id = $pdo->lastInsertId();
			return $cliente;
		}

		public function atualizar(Cliente $cliente) {
			$query = "UPDATE cliente SET nome = :nome, userEmail = :userEmail, senha = :senha, whatsappNumber = :whatsappNumber WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":nome", $cliente->nome);
			$comando->bindParam(":userEmail", $cliente->userEmail);
			$comando->bindParam(":senha", $cliente->senha);
            $comando->bindParam(":whatsappNumber", $cliente->whatsappNumber);
			$comando->bindParam(":id", $cliente->id);
			$comando->execute(); 
		}

		public function deletar($id) {
			$query = "DELETE from cliente WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $id);
			$comando->execute();
		}
	}
?>