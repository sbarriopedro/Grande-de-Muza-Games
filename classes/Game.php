<?php

class Game{

    private $gameID;
    private $gameName;
    private $gameDesc;
    private $gamePublish;
    private $gameRoute;
    
    public function listGames()
            {
                $link = Connection::connect();
                $sql = 'SELECT gameID,
                                gameName, gameDesc,
                                gamePublish,gameRoute
                        FROM games';
                $stmt = $link->prepare($sql);
                $stmt->execute();
                $gameList = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $gameList;
            }

    public function getGameByID()
            {
                $gameID = $_GET['gameID'];

                $link = Connection::connect();
                $sql = 'SELECT gameID,
                                gameName, gameDesc,
                                gamePublish,gameRoute
                        FROM games
                        WHERE gameID = '.$gameID;

                $stmt = $link->prepare($sql);
                $stmt->execute();
                $game = $stmt->fetch(PDO::FETCH_ASSOC);
                return $game;
            }

    public function uploadGameFile()
            {
                
                $gameFileName = $_FILES['gameFile']['name'];
                $gameRoute = 'games/'.$gameFileName;
                $gameFolder = 'games/'.pathinfo($gameRoute, PATHINFO_FILENAME).'/index.html';

                if( $_FILES['gameFile']['error'] == 0 ){
                    $gameFiletmp = $_FILES['gameFile']['tmp_name'];
                    // upload the file
                    move_uploaded_file($gameFiletmp, $gameRoute);
                    //extract zip
                    $zip = new ZipArchive();
                    if ($zip->open($gameRoute) === TRUE){
                        $zip->extractTo('games/');
                        $zip->close();
                    }
                }
            return $gameFolder;
            }


    public function addGame()
            {
                $gameName = $_POST['gameName'];
                $gameDesc = $_POST['gameDesc'];
                $gamePublish = $_POST['gamePublish'];
                $gameRoute = $this->uploadGameFile();

                $link = Connection::connect();
                $sql = 'INSERT INTO games (gameName, gameDesc,
                                            gamePublish, gameRoute)
                        VALUES (:gameName, :gameDesc,
                                :gamePublish, :gameRoute )';

                $stmt = $link->prepare($sql);
                $stmt->bindParam(":gameName", $gameName, PDO::PARAM_STR);
                $stmt->bindParam(":gameDesc", $gameDesc, PDO::PARAM_STR);
                $stmt->bindParam(":gamePublish", $gamePublish, PDO::PARAM_INT);
                $stmt->bindParam(":gameRoute", $gameRoute, PDO::PARAM_STR);

                if($stmt->execute()){
                    $this->setGameID($link->lastInsertId());
                    $this->setGameName($gameName);
                    $this->setGameDesc($gameDesc);
                    $this->setGamePublish($gamePublish);
                    $this->setGameRoute($gameRoute);
                    return true;
                }
                return false;
            }

    public function modifyGame()
            {
                
                $gameID = $_POST['gameID'];
                $gameName = $_POST['gameName'];
                $gameDesc = $_POST['gameDesc'];
                $gamePublish = $_POST['gamePublish'];
                $gameRoute = $_POST['gameRoute'];

                $gameRoute = $this->uploadGameFile();

                $link = Connection::connect();
                $sql = 'INSERT INTO games (
                        gameName, gameDesc,
                        gamePublish,gameRoute)
                VALUES (:gameName, :gameDesc,
                        :gamePublish, :gameRoute)
                WHERE gameID = '.$gameID;

                $stmt = $link->prepare($sql);
                $stmt->bindParam(":gameName", $gameName, PDO::PARAM_STR);
                $stmt->bindParam(":gameDesc", $gameDesc, PDO::PARAM_STR);
                $stmt->bindParam(":gamePublish", $gamePublish, PDO::PARAM_INT);
                $stmt->bindParam(":gameRoute", $gameRoute, PDO::PARAM_STR);

                if($stmt->execute()){
                    $this->setGameID($gameID);
                    $this->setGameName($gameName);
                    $this->setGameDesc($gameDesc);
                    $this->setGamePublish($gamePublish);
                    $this->setGameRoute($gameRoute);
                    return true;
                }
                return false;
            }
            
    public function deleteGame()
            {
                $gameID = $_POST['gameID'];

                $link = Connection::connect();
                $sql = 'DELETE FROM games
                        WHERE gameID = '.$gameID;
                    
                $stmt = $link->prepare($sql);
                $stmt->execute();
                return true;
            }


    ////////// GETTERS & SETTERS ////////////

    /**
     * Get the value of gameID
     */ 
    public function getGameID()
    {
        return $this->gameID;
    }

    /**
     * Set the value of gameID
     *
     * @return  self
     */ 
    public function setGameID($gameID)
    {
        $this->gameID = $gameID;

        return $this;
    }

    /**
     * Get the value of gameName
     */ 
    public function getGameName()
    {
        return $this->gameName;
    }

    /**
     * Set the value of gameName
     *
     * @return  self
     */ 
    public function setGameName($gameName)
    {
        $this->gameName = $gameName;

        return $this;
    }

    /**
     * Get the value of gameDesc
     */ 
    public function getGameDesc()
    {
        return $this->gameDesc;
    }

    /**
     * Set the value of gameDesc
     *
     * @return  self
     */ 
    public function setGameDesc($gameDesc)
    {
        $this->gameDesc = $gameDesc;

        return $this;
    }

    /**
     * Get the value of gamePublish
     */ 
    public function getGamePublish()
    {
        return $this->gamePublish;
    }

    /**
     * Set the value of gamePublish
     *
     * @return  self
     */ 
    public function setGamePublish($gamePublish)
    {
        $this->gamePublish = $gamePublish;

        return $this;
    }

    /**
     * Get the value of gameRoute
     */ 
    public function getGameRoute()
    {
        return $this->gameRoute;
    }

    /**
     * Set the value of gameRoute
     *
     * @return  self
     */ 
    public function setGameRoute($gameRoute)
    {
        $this->gameRoute = $gameRoute;

        return $this;
    }
}
