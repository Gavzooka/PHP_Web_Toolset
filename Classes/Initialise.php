<?php
/**
 * Created by PhpStorm.
 * User: Gavin
 * Date: 27/10/2016
 * Time: 17:20
 */

class Initialise
{
    public $config;
    public $dataConnection;


    function __construct()
    {
        require ('./Classes/Config.php');
        require ('./Classes/Database.php');
        require ('./Classes/Auditor.php');
        require ('./Classes/Logger.php');

        //TODO:  Add logic to control what is initialised.
        $this->config = new Config();

        //Instantiate Database connection, if configured
        if($this->config->getConfigSetting('dbServer')!=null) {
            $this->dataConnection = new Database($this->config->getConfigSetting('dbServer'),
                $this->config->getConfigSetting('dbUsername'), $this->config->getConfigSetting('dbPassword'), $this->config->getConfigSetting('dbName'));
        }


    }

}