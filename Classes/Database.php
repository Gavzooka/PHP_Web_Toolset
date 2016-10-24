<?php

/**
 * Created by PhpStorm.
 * User: Gavin
 * Date: 24/10/2016
 * Time: 16:20
 */
class Database
{
    private $dbServer;
    private $dbUsername;
    private $dbPassword;

    private $dbConnection;

    function __construct($server, $user, $password)
    {
        try {
            if($server!=null AND $user!=null AND $password!=null) {
                $this->dbServer = $server;
                $this->dbUsername = $user;
                $this->dbPassword = $password;

                $this->connect();
            } else {
                //TODO: Add Error Handler
                throw new Exception('Database connection Details invalid.');
            }
        } catch (Exception $err){
            echo 'Error : '.$err->getMessage().'<br>';
        }
    }

    function connect(){
        $this->dbConnection=mysqli_connect($this->dbServer,$this->dbUsername,$this->dbPassword);
        if(mysqli_connect_error()){
            //TODO: Add Error Handler
            throw new Exception('Connection Error');
        }
    }

    function close(){
        if($this->dbConnection==true) {
            $this->dbConnection->close();
        }
    }



}