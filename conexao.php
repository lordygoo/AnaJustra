<?php
/**
* Classe de Conexão
*/
Class Conexao {
	
	public $conexao;
	public $hostname = "sql50.main-hosting.eu";
    public $username = "u124677850_root";
    public $password = "10203040aa";

	function __construct()
	{
		//$conn = $this->conectaBanco("localhost","root","",$basename);
		//$conn = $this->conectaBanco($hostname, $user,$pass,"u124677850_anaju");

		$conn = $this->conectaBanco($this->hostname, $this->user, $this->pass, "u124677850_anaju");

		//if(is_resource($conn) && get_resource_type($conn) === 'mysql link'){
		if($conn && !mysqli_connect_errno()){
			$this->conexao = $conn;
		}else{
			$this->conexao = $this->conectaBanco($this->hostname, $this->user, $this->pass, "u124677850_anaju");
		}
	}

	function conectaBanco($host, $usuario, $senha, $basename){
		return mysqli_connect($host, $usuario, $senha, $basename);
	}
}