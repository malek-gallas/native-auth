<?php

class Database {

    //PDO Object
    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
        try{
            $this->dbh = new PDO('sqlite:./db/auth.db');
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->exec('CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                first_name VARCHAR(255) NOT NULL,
                last_name VARCHAR(255) NOT NULL,
                token VARCHAR(255) NOT NULL,
                token_expiration DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                failed_login_attempts INTEGER NOT NULL DEFAULT 0,
                locked INTEGER NOT NULL DEFAULT 0,
                lockout_expiration DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                isValid INTEGER NOT NULL DEFAULT 0,
                UNIQUE(email)
            )');
            $this->dbh->exec('CREATE INDEX IF NOT EXISTS idx_email ON users(email)');
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    //Prepare statement
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    //Bind values to prepared statement
    public function bind($param, $value, $type = NULL){
        if(is_null ($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //Execute the prepared statement
    public function execute(){
        return $this->stmt->execute();
    }

    //Fetch all records
    public function fetchAll(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //Fetch single record
    public function fetch(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //Get row count
    public function rowCount(){
        $this->stmt = $this->dbh->query("SELECT COUNT(*) FROM users");
        $rows = (int) $this->stmt->fetchColumn();
        return $rows;
    }

}

