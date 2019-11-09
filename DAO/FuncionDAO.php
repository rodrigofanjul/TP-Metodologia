<?php
	namespace DAO;

	use Models\Funcion as Funcion;
	use Models\Genero as Genero;

	class FuncionDAO
	{
		private $connection;
		private $tableName = "Funciones";

		public function add($funcion)
		{
			try 
			{
				$query = "INSERT INTO " . $this->tableName . " (id_cine, id_sala, id_pelicula, fecha_hora) VALUES (:id_cine, :id_sala, :id_pelicula, :fecha_hora);";

				$parameters["id_cine"] = $funcion->getIdCine();
				$parameters["id_sala"] = $funcion->getIdSala();
				$parameters["id_pelicula"] = $funcion->getIdPelicula();
				$parameters["fecha_hora"] = $funcion->getFechaHora();

				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
				return true;
			} 
			catch (Exception $ex) 
			{
				return false;
			}
		}

		function remove($funcion)
		{
			try 
			{
				$query = "DELETE FROM " . $this->tableName . " WHERE id_funcion = :id_funcion;";

				$parameters['id_funcion'] = $funcion->getId();

				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
				return true;
			} 
			catch (Exception $ex) 
			{
				return false;
			}
		}

		public function getAll()
		{
			try 
			{
				$list = array();
				$query = "SELECT * FROM " . $this->tableName;
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);

				foreach ($resultSet as $row) {
					$funcion = new Funcion();
					$funcion->setId($row["id_funcion"]);
					$funcion->setIdCine($row["id_cine"]);
					$funcion->setIdSala($row["id_sala"]);
					$funcion->setIdPelicula($row["id_pelicula"]);
					$funcion->setFechaHora($row["fecha_hora"]);
					array_push($list, $funcion);
				}
				return $list;
			} 
			catch (Exception $ex) 
			{
				return null;
			}
		}

		public function getDistinctPeliculas()
		{
			try 
			{
				$list = array();
				$query = "SELECT DISTINCT id_pelicula FROM " . $this->tableName;
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);

				foreach ($resultSet as $row) {
					$funcion = new Funcion();
					$funcion->setIdPelicula($row["id_pelicula"]);
					array_push($list, $funcion);
				}
				return $list;
			} 
			catch (Exception $ex) 
			{
				return null;
			}
		}

		public function getDistinctCines()
		{
			try 
			{
				$list = array();
				$query = "SELECT DISTINCT id_cine FROM " . $this->tableName;
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);

				foreach ($resultSet as $row) 
				{
					$funcion = new Funcion();
					$funcion->setIdCine($row["id_cine"]);
					array_push($list, $funcion);
				}
				return $list;
			} 
			catch (Exception $ex) 
			{
				return null;
			}
		}

		//EN PROCESO
		public function getFuncionesDisponiblesPorFecha()
		{
			try 
			{
				$list = array();
				$query = "SELECT DISTINCT id_pelicula FROM " . $this->tableName. " WHERE (fecha_hora > now())";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);

				foreach ($resultSet as $row) {
					$funcion = new Funcion();
					$funcion->setIdPelicula($row["id_pelicula"]);
					array_push($list, $funcion);
				}
				return $list;
			} 
			catch (Exception $ex) 
			{
				return null;
			}
		}

		public function getFuncion($funcion)
		{
			try 
			{
				$query = "SELECT * FROM " . $this->tableName . " WHERE id_funcion = '" . $funcion->getId() . "';";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);

				foreach ($resultSet as $row) 
				{
					$funcion->setId($row["id_funcion"]);
					$funcion->setIdCine($row["id_cine"]);
					$funcion->setIdSala($row["id_sala"]);
					$funcion->setIdPelicula($row["id_pelicula"]);
					$funcion->setFechaHora($row["fecha_hora"]);
					return $funcion;
				}
			} 
			catch (Exception $ex) 
			{
				return null;
			}
		}

		public function getByCine($cine)
		{
			try 
			{
				$list = array();
				$query = "SELECT * FROM " . $this->tableName . " WHERE id_cine = " . $cine->getId() . ";";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);

				foreach ($resultSet as $row) 
				{
					$funcion = new Funcion();
					$funcion->setId($row["id_funcion"]);
					$funcion->setIdCine($row["id_cine"]);
					$funcion->setIdSala($row["id_sala"]);
					$funcion->setIdPelicula($row["id_pelicula"]);
					$funcion->setFechaHora($row["fecha_hora"]);
					array_push($list, $funcion);
				}
				return $list;
			} 
			catch (Exception $ex) 
			{
				return null;
			}
		}


		public function getByPelicula($pelicula)
		{
			try 
			{
				$list = array();
				$query = "SELECT * FROM " . $this->tableName . " WHERE id_pelicula = " . $pelicula->getId() . " AND fecha_hora >= NOW();";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);

				foreach ($resultSet as $row) 
				{
					$funcion = new Funcion();
					$funcion->setId($row["id_funcion"]);
					$funcion->setIdCine($row["id_cine"]);
					$funcion->setIdSala($row["id_sala"]);
					$funcion->setIdPelicula($row["id_pelicula"]);
					$funcion->setFechaHora($row["fecha_hora"]);
					array_push($list, $funcion);
				}
				return $list;
			} 
			catch (Exception $ex) 
			{
				return null;
			}
		}

		public function getByCinePelicula($cine, $pelicula)
		{
			try 
			{
				$list = array();
				$query = "SELECT * FROM " . $this->tableName . " WHERE id_cine = " . $cine->getId() . " AND id_pelicula = " . $pelicula->getId() . " AND fecha_hora >= NOW();";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);

				foreach ($resultSet as $row) 
				{
					$funcion = new Funcion();
					$funcion->setId($row["id_funcion"]);
					$funcion->setIdCine($row["id_cine"]);
					$funcion->setIdSala($row["id_sala"]);
					$funcion->setIdPelicula($row["id_pelicula"]);
					$funcion->setFechaHora($row["fecha_hora"]);
					array_push($list, $funcion);
				}
				return $list;
			} 
			catch (Exception $ex) 
			{
				return null;
			}
		}

		public function checkAvailablePelicula($idPelicula, $fecha)
		{
			try 
			{
				$list = array();
				$query = "SELECT id_cine FROM " . $this->tableName . " WHERE id_pelicula = " . $idPelicula . " AND fecha_hora LIKE '" . $fecha . "%';";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);

				foreach ($resultSet as $row) 
				{
					$funcion = new Funcion();
					$funcion->setIdCine($row["id_cine"]);
					array_push($list, $funcion);
				}
				return $list;
			} 
			catch (Exception $ex) 
			{
				return null;
			}
		}

		public function getDistinctCineByPelicula($idPelicula)
		{
			try 
			{
				$list = array();
				$query = "SELECT DISTINCT id_cine, id_pelicula FROM " . $this->tableName . " WHERE id_pelicula = '" . $idPelicula . "'" . " AND fecha_hora>= NOW();";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);

				foreach ($resultSet as $row) 
				{
					$funcion = new Funcion();
					$funcion->setIdCine($row["id_cine"]);
					$funcion->setIdPelicula($row["id_pelicula"]);
					array_push($list, $funcion);
				}
				return $list;
			} 
			catch (Exception $ex) 
			{
				return null;
			}
		}

		public function edit($funcion)
		{
			try 
			{
				$query = "UPDATE " . $this->tableName . " SET id_cine = :id_cine, id_sala = :id_sala, id_pelicula = :id_pelicula, fecha_hora = :fecha_hora WHERE id_funcion = :id_funcion;";

				$parameters["id_cine"] = $funcion->getIdCine();
				$parameters["id_sala"] = $funcion->getIdSala();
				$parameters["id_pelicula"] = $funcion->getIdPelicula();
				$parameters["fecha_hora"] = $funcion->getFechaHora();
				$parameters["id_funcion"] = $funcion->getId();

				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
				return true;
			} 
			catch (Exception $ex) 
			{
				return false;
			}
		}
			
	}
?>
