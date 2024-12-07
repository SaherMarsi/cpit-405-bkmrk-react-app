<?php

class bkmrk{
    private $id;
    private $urls;
    private $title;
    private $dateAdded;
    private $dbConnection;
    private $dbTable = 'bookmarks';

    //constructor 
    public function __construct($dbConnection){
        $this->dbConnection = $dbConnection;
    }
    //getters
    public function getId(){
        return $this->id;
    }
    public function getUrls(){
        return $this->urls;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getDateAdded(){
        return $this->dateAdded;
    }
    //setters
    public function setId($id){
        $this->id = $id;
    }
    public function setUrls($urls){
        $this->urls = $urls;
    }
    public function setTitle($title){
        $this->title = $title;
    }
    public function setDateAdded($dateAdded){
        $this->dateAdded = $dateAdded;
    }

    public function create(){
        $query = "INSERT INTO ".$this->dbTable." (urls,title,date_added) VALUES(:urlsName, :titleName, now());";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(":urlsName",$this->urls);
        $stmt->bindParam(":titleName",$this->title);
        if($stmt->execute()){
            return true;
        }
        printf("Error :%s", $stmt->error);
        return false;
    }

    public function readOne(){
        $query = "SELECT * FROM " . $this->dbTable . " WHERE id=:id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(":id", $this->id);
        if($stmt->execute() && $stmt->rowCount()==1){
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            $this->id = $result->id;
            $this->urls = $result->urls;
            $this->title = $result->title;
            $this->dateAdded = $result->date_added;
            return true;
        }
        return false;
    }

    public function readAll(){
        $query = "SELECT * FROM ".$this->dbTable;
        $stmt = $this->dbConnection->prepare($query);
        if($stmt->execute() && $stmt->rowCount()>0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function update(){
        $query ="UPDATE ".$this->dbTable." SET urls=:urls, title=:title WHERE id=:id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(":urls", $this->urls);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":id", $this->id);
        if($stmt->execute() && $stmt->rowCount()==1){
            return true;
        }
        return false;
    }

    public function delete(){
        $query = "DELETE FROM ".$this->dbTable." WHERE id=:id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(":id", $this->id);
        if($stmt->execute() && $stmt->rowCount()==1){
            return true;
        }
        return false;
    }
}