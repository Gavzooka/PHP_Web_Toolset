<?php
/**
 * Created by PhpStorm.
 * User: Gavin
 * Date: 23/10/2016
 * Time: 17:32
 */

    //TODO: Create a tools file to include shared utilities - e.g. Normalise Path

    require ('./Classes/Initialise.php');

    session_start();
    $_SESSION['Configuration'] = new Initialise();
    $_SESSION['Configuration']->config->debug_OutputSettings();
    $_SESSION['Configuration']->dataConnection->close();

?>