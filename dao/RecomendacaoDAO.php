<?php
	include_once "./class/Recomendacao.php";
	include_once "./db/PDOFactory.php";

	class RecomendacaoDAO {

		public function listar() {
			$query = "SELECT * FROM recomendacao";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$recomendacoes = array();	
			while($row = $comando->fetch(PDO::FETCH_OBJ)) {
				$recomendacoes[] = new Recomendacao($row->id,$row->tipo,$row->titulo,$row->descricao);
			}
			return $recomendacoes;
        }

		public function buscarPorId($id) {
			$query = "SELECT * FROM recomendacao WHERE id = :id";		
			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("id", $id);
			$comando->execute();
			$resultado = $comando->fetch(PDO::FETCH_OBJ);
			return new Recomendacao($resultado->id, $resultado->tipo, $resultado->titulo, $resultado->descricao);           
		}

		public function inserir(Recomendacao $recomendacao) {
			$query = "INSERT INTO recomendacao(tipo, titulo, descricao) VALUES (:tipo, :titulo, :descricao)";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
            $comando->bindParam(":tipo", $recomendacao->tipo);
            $comando->bindParam(":titulo", $recomendacao->titulo);
            $comando->bindParam(":descricao", $recomendacao->descricao);
			$comando->execute();
			$recomendacao->id = $pdo->lastInsertId();
			return $recomendacao;
		}

		public function atualizar(Recomendacao $recomendacao) {
			$query = "UPDATE recomendacao SET tipo = :tipo, titulo = :titulo, descricao =:descricao WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":tipo", $recomendacao->tipo);
            $comando->bindParam(":titulo", $recomendacao->titulo);
            $comando->bindParam(":descricao", $recomendacao->descricao);
			$comando->bindParam(":id", $recomendacao->id);
			$comando->execute(); 
		}

		public function deletar($id) {
			$query = "DELETE from recomendacao WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $id);
			$comando->execute();
		}
	}
?>