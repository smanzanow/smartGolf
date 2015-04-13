<?php
class Jugador {
	
	function GetJugadores() {
		try{
			$link = new PDO('mysql:host=mysql2.000webhost.com;dbname=a1603507_golfDB;charset=utf8mb4', 
						'a1603507_admin', 
						'golfadmin1', 
						array(
							PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
							PDO::ATTR_PERSISTENT => false
						)
					);

			$handle = $link->prepare('select Id, Nombre, CLave, EsAdmin from Jugador');
		
			$handle->execute();
			$result = $handle->fetchAll(PDO::FETCH_OBJ);
	 
			$link = null;
		
			return $result;
		}
		catch(PDOException $ex){
			return $ex->getMessage();
		}
	}
	function GetJugador($id) {
		try{
			$link = new PDO('mysql:host=mysql2.000webhost.com;dbname=a1603507_golfDB;charset=utf8mb4', 
						'a1603507_admin', 
						'golfadmin1', 
						array(
							PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
							PDO::ATTR_PERSISTENT => false
						)
					);

			$handle = $link->prepare('select Id, Nombre, CLave, EsAdmin from Jugador where Id = ?');
			$handle->bindValue(1, $id, PDO::PARAM_INT);


			$handle->execute();
			$result = $handle->fetchAll(PDO::FETCH_OBJ);
	 
			$link = null;
			return $result;
		}
		catch(PDOException $ex){
			echo $ex->getMessage();
			return $ex->getMessage();
		}
	}
	function GetAdmins() {
		
		try{
			$link = new PDO('mysql:host=mysql2.000webhost.com;dbname=a1603507_golfDB;charset=utf8mb4', 
						'a1603507_admin', 
						'golfadmin1', 
						array(
							PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
							PDO::ATTR_PERSISTENT => false
						)
					);

			$handle = $link->prepare('select Id, Nombre, CLave, EsAdmin from Jugador where EsAdmin = 1');

		
			$handle->execute();
			$result = $handle->fetchAll(PDO::FETCH_OBJ);
	 
			$link = null;
		
			return $result;
		}
		catch(PDOException $ex){
			return $ex->getMessage();
		}
	}
	function GetNextId() {
		try{
			$link = new PDO('mysql:host=mysql2.000webhost.com;dbname=a1603507_golfDB;charset=utf8mb4', 
						'a1603507_admin', 
						'golfadmin1', 
						array(
							PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
							PDO::ATTR_PERSISTENT => false
						)
					);

			$handle = $link->prepare('select MAX(Id) as Id from Jugador');
		
			$handle->execute();
			$result = $handle->fetchAll(PDO::FETCH_OBJ);

			return $result[0]->Id;
		}
		catch(PDOException $ex){
			return $ex->getMessage();
		}
	}
	function CreateJugador($nombre, $clave, $esAdmin) {
		try{
		    
			$link = new PDO('mysql:host=mysql2.000webhost.com;dbname=a1603507_golfDB;charset=utf8mb4', 
						'a1603507_admin', 
						'golfadmin1', 
						array(
							PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
							PDO::ATTR_PERSISTENT => false
						)
					);
					
			$id = $this->GetNextId()+1;
			$handle = $link->prepare('INSERT INTO Jugador VALUES (?,?,?,?)');
			$handle->bindValue(1, $id, PDO::PARAM_INT);
			$handle->bindValue(2, $nombre, PDO::PARAM_STR);
			$handle->bindValue(3, $clave, PDO::PARAM_STR);
			$handle->bindValue(4, $esAdmin, PDO::PARAM_INT);
			
			$handle->execute();
			return $this->GetJugador($id);

		}
		catch(PDOException $ex){
			echo $ex->getMessage();
			return $ex->getMessage();
		}
	}
	function ValidarAdmin($nombre, $clave) {
		try{
			$link = new PDO('mysql:host=mysql2.000webhost.com;dbname=a1603507_golfDB;charset=utf8mb4', 
						'a1603507_admin', 
						'golfadmin1', 
						array(
							PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
							PDO::ATTR_PERSISTENT => false
						)
					);

			$handle = $link->prepare('SELECT COUNT(*) as num FROM `Jugador` where Nombre = ? and CLave = ?  and EsAdmin=1');
		
			
			$handle->bindValue(1, $nombre, PDO::PARAM_STR);
			$handle->bindValue(2, $clave, PDO::PARAM_STR);
		
			$handle->execute();
			$result = $handle->fetchAll(PDO::FETCH_OBJ);
	 
			$link = null;

			if($result[0]->num>0) return true;
			else return false;
		}
		catch(PDOException $ex){
			return $ex->getMessage();
		}
	}
}
?>	