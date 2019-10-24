<?php
	include_once "./class/HistoricoSessao.php";
	include_once "./db/PDOFactory.php";

	class HistoricoSessaoDAO {

		public function listar() {
			$query = "SELECT * FROM historico";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$historicos = array();	
			while($row = $comando->fetch(PDO::FETCH_OBJ)) {
				$historicos[] = new HistoricoSessao($row->id,$row->numero,$row->data,$row->titulo,$row->descricao);
			}
			return $historicos;
        }

		public function buscarPorId($id) {
			$query = "SELECT * FROM historico WHERE id = :id";		
			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("id", $id);
			$comando->execute();
			$resultado = $comando->fetch(PDO::FETCH_OBJ);
			return new HistoricoSessao($resultado->id, $resultado->numero, $resultado->data, $resultado->titulo, $resultado->descricao);           
		}

		public function inserir(HistoricoSessao $historico) {
			$query = "INSERT INTO historico(numero, data, titulo, descricao) VALUES (:numero, :data, :titulo, :descricao)";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
            $comando->bindParam(":numero", $historico->numero);
            $comando->bindParam(":data", $historico->data);
            $comando->bindParam(":titulo", $historico->titulo);
            $comando->bindParam(":descricao", $historico->descricao);
			$comando->execute();
			$historico->id = $pdo->lastInsertId();
			return $historico;
		}

		public function atualizar(HistoricoSessao $historico) {
			$query = "UPDATE historico SET numero = :numero, data = :data, titulo = :titulo, descricao =:descricao WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":numero", $historico->numero);
            $comando->bindParam(":data", $historico->data);
            $comando->bindParam(":titulo", $historico->titulo);
            $comando->bindParam(":descricao", $historico->descricao);
			$comando->bindParam(":id", $historico->id);
			$comando->execute(); 
		}

		public function deletar($id) {
			$query = "DELETE from historico WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $id);
			$comando->execute();
		}
	}
?>