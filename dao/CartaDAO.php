<?php
	include_once "./class/Carta.php";
	include_once "./db/PDOFactory.php";

	class CartaDAO {

		public function listar() {
			$query = "SELECT * FROM carta";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$cartas = array();	
			while($row = $comando->fetch(PDO::FETCH_OBJ)) {
				$cartas[] = new Carta($row->id,$row->titulo,$row->descricao);
			}
			return $cartas;
		}

		public function buscarPorId($id) {
			$query = "SELECT * FROM carta WHERE id = :id";		
			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("id", $id);
			$comando->execute();
			$resultado = $comando->fetch(PDO::FETCH_OBJ);
			return new Carta($resultado->id, $resultado->titulo, $resultado->descricao);           
		}

		public function inserir(Carta $carta) {
			$query = "INSERT INTO carta(titulo, descricao) VALUES (:titulo, :descricao)";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":titulo", $carta->titulo);
            $comando->bindParam(":descricao", $carta->descricao);
			$comando->execute();
			$carta->id = $pdo->lastInsertId();
			return $carta;
		}

		public function atualizar(Carta $carta) {
			$query = "UPDATE carta SET titulo = :titulo, descricao = :descricao WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":titulo", $carta->titulo);
			$comando->bindParam(":descricao", $carta->descricao);
			$comando->bindParam(":id", $carta->id);
			$comando->execute(); 
		}

		public function deletar($id) {
			$query = "DELETE from carta WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $id);
			$comando->execute();
		}
	}
?>