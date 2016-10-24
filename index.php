<?php
/**
 * Created by PhpStorm.
 * User: Gavin
 * Date: 23/10/2016
 * Time: 17:32
 */

    //TODO: Create a tools file to include shared utilities - e.g. Normalise Path

    session_start();
    require ('./Classes/Config.php');
    require ('./Classes/Database.php');

    $config = new Config();
    $config->debug_OutputSettings();

    $dataConnection = new Database($config->getConfigSetting('dbServer'),
        $config->getConfigSetting('dbUsername'),$config->getConfigSetting('dbPassword'));

    $dataConnection->close();

    /*
    echo $config->getConfigSetting("test").'<br>';
    echo session_id().'<br>';
    echo 'Hello World!';
    */
?>