<?php
   error_reporting(E_ALL);
   ini_set("display_errors", 1);
   $serverName = "GISVM104\GRIZZLY";
   $connectionInfo = array("UID" => "[SQL Server User Name]", "PWD" => "[Password]", "Database"=>"[Database Name]");
   $conn = sqlsrv_connect( $serverName, $connectionInfo);


     $is_addr=FALSE;

     $queryString="";
     if(isset($_GET['term'])) {
                  $queryString=$_GET['term'];
     }
     if(isset($_GET['name'])) {
                  $queryString=$_GET['name'];
     }
     //echo $queryString."<BR>";



     $rcnt=0;

     echo "[";

     if(!$conn) {
   		// Show error if we cannot connect.
         echo 'ERROR: Could not connect to the database.';
   	} else {


         if(strlen($queryString) > 0) {

                $resfld="pin";
   				$query = "SELECT distinct top 10 ".$resfld." FROM central_siteaddress WHERE ".$resfld." LIKE '$queryString%' ORDER BY ".$resfld;

   	            $stmt = sqlsrv_query( $conn, $query);

   			    if( $stmt === false )
   			    {
   			  	   echo "Error in statement preparation/execution.\n";
   				   die( print_r( sqlsrv_errors(), true));
   			    }


   			    while($row = sqlsrv_fetch_array($stmt)){

   				         if ($rcnt==0){
   				           echo  "{\"name\":\"".$row[$resfld]."\", id:\"$rcnt\"}";
   				         } else {
   				           echo  ",{\"name\": \"".$row[$resfld]."\", id:\"$rcnt\"}";
   				         }




   				         $rcnt=$rcnt+1;
   			    }




   				sqlsrv_free_stmt( $stmt);

   		} else {
   			echo "There should be no direct access to this script!";
   		}
   	}

     echo "]";
     sqlsrv_close( $conn);
?>