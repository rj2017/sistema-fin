<?php 

	class MySql{

		private static $pdo;

		public static function conectarDb(){

			if (self::$pdo == null) {
				try{
					self::$pdo = new PDO('mysql:host='.HOST.';dbname='.DB,USER,PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
					self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}catch(Exception $e){
					echo '<script>alert("erro ao conectar ao Banco de dados!")</script>';
				}
			}

			return self::$pdo;

		}
	}

	
 ?>