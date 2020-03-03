<?php

class User{
    private $userID;
    private $userLevel;
    private $userName;
    private $userPass;

    public function listUsers()
	{
		$link = Connection::connect();
		$sql = "SELECT userID, userLevel, userName
				FROM users";
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $userList = $stmt->fetchall(PDO::FETCH_ASSOC);
        return $userList;
    }
    
    public function addUser()
	{
		$userLevel = $_POST['userLevel'];
		$userName = $_POST['userName'];
		$userPass = password_hash($_POST['userPass'], PASSWORD_BCRYPT());
		
		$link = Connection::connect();
		$sql = "INSERT INTO users (userLevel,userName,userPass)
                VALUES(:userLevel , :userName , :userPass)";
                
        $stmt = $link->prepare($sql);
        $stmt->bindParam(":userLevel", $userLevel, PDO::PARAM_INT);
        $stmt->bindParam(":userName", $userName, PDO::PARAM_STR);
        $stmt->bindParam(":userPass", $userPass, PDO::PARAM_STR);

		if($stmt->execute()){
            $this->setUserID($link->lastInsertId());
            $this->setUserLevel($userLevel);
            $this->setUserName($userName);
            $this->setUserPass($userPass);
            return true;
        }
        return false;
    }

    public function getUserByID()
    {
        $userID = $_GET['userID'];

        $link = Connection::connect();
        $sql = "SELECT userID, userLevel ,userName, userPass
	                FROM users
                    WHERE userID = :userID";

        $stmt = $link->prepare($sql);
        $stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function modifyUser()
    {
        $userID = $_POST['userID'];
        $userLevel = $_POST['userLevel'];
        $userName = $_POST['userName'];
        $userPass = password_hash($_POST['userPass'], PASSWORD_BCRYPT());

        $link = Connection::connect();
        $sql = 'INSERT INTO users (
            userLevel, userName,
            userPass)
            VALUES ( :userLevel, :userName,
            :userPass)
            WHERE userID = :userID';

        $stmt = $link->prepare($sql);
        $stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
        $stmt->bindParam(":userLevel", $userLevel, PDO::PARAM_INT);
        $stmt->bindParam(":userName", $userName, PDO::PARAM_STR);
        $stmt->bindParam(":userPass", $userPass, PDO::PARAM_STR);

        if($stmt->execute()){
            $this->setUserID($userID);
            $this->setUserLevel($userLevel);
            $this->setUserName($userName);
            $this->setUserPass($userPass);
            return true;
        }
        return false;
    }

    public function deleteUser()
    {
        $userID = $_POST['userID'];

        $link = Connection::connect();
        $sql = "DELETE FROM users
                WHERE userID =".$userID;

        $stmt = $link->prepare($sql);
        if($stmt->execute()){
            return true;
        };
        return false;
    }
    function login()
    {
        $userName = $_POST['userName'];
        $userPass = password_hash($_POST['userPass'], PASSWORD_BCRYPT());
        $link = Connection::connect();
        $sql = "SELECT userName, userLevel 
                    FROM users
                    WHERE userName = :userName
                     AND  userPass = :userPass";
        $stmt = $link->prepare($sql);
        $stmt-execute();
        $quantity = $stmt->fetch(PDO::FETCH_ASSOC);
        if($quantity == 0){
            header('location: formLogin.php?error=1');
        }
        else{
            // authentication routine
            session_start();
            $_SESSION['login'] = $quantity['userLevel'];
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['userName'] = $user['userName'];
            $_SESSION['userLevel'] = $user['userLevel'];
            //redirección
            header('location: admin.php');
        }
    }

}