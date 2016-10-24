<?php

/**
 * Created by PhpStorm.
 * User: Gavin
 * Date: 23/10/2016
 * Time: 17:46
 */
class Config
{

    private $INIname='config.ini';
    private $INIPath='../';

    private $INIArray;

    //Variable List - Must be here to be read from INI file.
    //TODO: Debug/Audit Table column names?
    private $debug;                 //Enable/Disable Debug Log
    private $debugLocation;         //0=File, 1=database
    private $debugFile;             //Name of file to record debug log data
    private $debugTable;            //Name of table to record debug lof data

    private $dbServer;              //Name/IP of MySQL Server
    private $dbUsername;            //Username for MySQL Server access
    private $dbPassword;            //Password for MySQL Server access
    private $dbName;                //Name of database

    private $audit;                 //Enable/Disable Auditing
    private $auditLocation;         //0=file, 1=database
    private $auditFile;             //Name of file to record audit data
    private $auditTable;            //Name of table to record audit data


    function __construct()
    {

        //TODO: Add string to log actions -> Output once verified what logging in enabled
        //TODO: Once log actions implemented, add catch to log exceptions
        try {
            if ($this->checkINISecure($this->INIPath . '/' . $this->INIname)) {
                if (file_exists($this->INIPath . '/' . $this->INIname)) {
                    //Parse Config File in to Array
                    $this->INIArray = parse_ini_file($this->INIPath . '/' . $this->INIname);

                    //Loop through Array and split in to class variables
                    foreach ($this->INIArray as $key => $value) {
                        //Does item in INI file exist as variable?
                        if (property_exists($this, $key)) {
                            $this->$key = $value;
                        }
                        /*else {
                            echo 'Configuration item is not present.<br>';
                        }*/
                    }
                } else {
                    //TODO: Add Error Handler
                    throw new Exception('INI File not found.');
                }
            } else {
                //TODO: Add Error Handler
                throw new Exception('INI Path is not secure.');
            }
        } catch (Exception $err){
            echo 'Error : '.$err->getMessage().'<br>';
        }

    }

    //TODO: Temporary function to check configuration. Remove?
    function debug_OutputSettings(){
        echo 'Debug             : '.($this->debug==null?'Disabled':'Enabled').'<br>';
        echo 'Debug Location    : '.($this->debugLocation==null?'':$this->debugLocation).'<br>';
        echo 'Debug File        : '.($this->debugFile==null?'':$this->debugFile).'<br>';
        echo 'Debug Table       : '.($this->debugTable==null?'':$this->debugTable).'<br>';
        echo 'Database Server   : '.($this->dbServer==null?'':$this->dbServer).'<br>';
        echo 'Database Name     : '.($this->dbName==null?'':$this->dbName).'<br>';
        echo 'Database Username : '.($this->dbUsername==null?'':$this->dbUsername).'<br>';
        echo 'Database Password : '.($this->dbPassword==null?'':$this->dbPassword).'<br>';
        echo 'Audit             : '.($this->audit==null?'':$this->audit).'<br>';
        echo 'Audit Location    : '.($this->auditLocation==null?'':$this->auditLocation).'<br>';
        echo 'Audit File        : '.($this->auditFile==null?'':$this->auditFile).'<br>';
        echo 'Audit Table        : '.($this->auditTable==null?'':$this->auditTable).'<br>';
    }


    //TODO: Check function processes correctly when ran from various directories within a given path
    function checkINISecure($INILocation){
        $currentPosition = 0;
        $countOfMatches = 0;
        $rootPath = $_SERVER['DOCUMENT_ROOT'];

        if(file_exists($INILocation)) {
            $INIRealPath = realpath($INILocation);

            //Replace \ with / in paths as they may differ from source to source
            $INIRealPath = str_replace('\\', '/', $INIRealPath);
            $rootPath = str_replace('\\', '/', $rootPath);

            $rootPathLength = strlen($rootPath);

            while (substr($INIRealPath, $currentPosition, 1) == substr($rootPath, $currentPosition, 1)) {
                $countOfMatches++;
                $currentPosition++;
            }

            //TODO: Check Logic.  Should this really be DOCUMENT_ROOT length? What if running from subdirectory?
            if ($rootPathLength > $countOfMatches) {
                return true;
            } else {
                return false;
            }
        } else {
            //TODO: Add Error Handler
            throw new Exception($INILocation.' does not exist.');
        }
    }

    function getConfigSetting($setting){
        return $this->$setting;
    }
}