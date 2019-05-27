<?php

require_once('dbconfig.php');

class usuarios{

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($valor){
		try{
		    $uname = $valor["nome"];
		    $umail = $valor["email"];
		    $upass = $valor["senha"];
		    $ugroup = ($valor["grupo"] != "" ? $valor["grupo"] : 'Normal');
		    $userid = ($valor["usuarioid"] != "" ? $valor["usuarioid"] : 0);

            $new_password = password_hash($upass, PASSWORD_DEFAULT);

            if($uname=="")	{
                return "preencha o nome!";
            }
            else if($umail=="")	{
                return "preencha o email!";
            }
            else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
                return 'Preencha com um email válido!';
            }
            else if($upass=="")	{
                return "preencha a senha!";
            }
            else if(strlen($upass) < 6){
                return "Senha deve possuir mais de 6 cacarcteres";
            }
            else {
                $stmt = $this->conn->prepare("SELECT nome, email FROM usuarios WHERE email=:umail and excluido = 'N' and usuarioid != :uid");
                $stmt->bindparam(":uid", $userid);
                $stmt->bindparam(":umail", $umail);
                $stmt->execute();
                $row=$stmt->fetch(PDO::FETCH_ASSOC);

                if($row['email']==$umail) {
                    return "Email já cadastrado!";
                }
                else {
                    if ($userid <= 0) {
                        $stmt = $this->conn->prepare("INSERT INTO usuarios(nome,email,senha, grupo) VALUES(:uname, :umail, :upass, :ugroup)");
                        $stmt->bindparam(":uname", $uname);
                        $stmt->bindparam(":umail", $umail);
                        $stmt->bindparam(":upass", $new_password);
                        $stmt->bindparam(":ugroup", $ugroup);
                    } else {
                        $stmt = $this->conn->prepare("UPDATE usuarios SET nome = :uname, email = :umail, senha =:upass, grupo = :ugroup WHERE usuarioid = :uid");
                        $stmt->bindparam(":uname", $uname);
                        $stmt->bindparam(":umail", $umail);
                        $stmt->bindparam(":upass", $new_password);
                        $stmt->bindparam(":ugroup", $ugroup);
                        $stmt->bindparam(":uid", $userid);
                    }

                    $stmt->execute();
                    return "0";
                }
            }
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}				
	}

    public function deletar($uid){
        try{
            $stmt = $this->conn->prepare("UPDATE usuarios SET excluido = 'S' WHERE usuarioid = :uid");
            $stmt->bindparam(":uid", $uid);
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
	
	
	public function doLogin($umail,$upass){
		try{
			$stmt = $this->conn->prepare("SELECT usuarioid, nome, email, senha, grupo FROM usuarios WHERE email=:umail AND excluido = 'N'");
			$stmt->execute(array(':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1){
				if(password_verify($upass, $userRow['senha'])){
					$_SESSION['user_session'] = $userRow['usuarioid'];
                    $_SESSION['nome'] = $userRow['nome'];
                    $_SESSION['grupo'] = $userRow['grupo'];
					return true;
				}
				else{
					return false;
				}
			}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin(){
		if(isset($_SESSION['user_session'])) {
			return true;
		}
	}
	
	public function redirect($url){
		header("Location: $url");
	}
	
	public function doLogout(){
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>