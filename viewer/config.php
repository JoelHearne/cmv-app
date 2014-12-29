<?php

   $serverName = "[SERVER NAME]\[SQL SERVER INSTANCE NAME]";
   $connectionInfo = array("UID" => "[SQL Server User Name]", "PWD" => "[Password]", "Database"=>"[Database Name]");
   $conn = sqlsrv_connect( $serverName, $connectionInfo);

?>