<?php

////Conexion via local
//$conexion = mysql_connect('localhost','root','root') or die ('Error en conexión');
//$db = mysql_select_db('supermarketNotNull',$conexion) or die("No existe");
//mysql_set_charset('utf8');
//
////$mysql_host = "mysql3.000webhost.com";
////$mysql_database = "a4376984_portalI";
////$mysql_user = "a4376984_notnull";
////$mysql_password = "portal01";
////$conexion = mysql_connect($mysql_host,$mysql_user,$mysql_password) or die ('Error en conexion');
////$db = mysql_select_db($mysql_database,$conexion) or die("No existe");
////mysql_set_charset('utf8');

//Conexion via PDO

class conexion 
{
    private $conn ;
    function __construct() 
    {
       $servername = "localhost";
       $username = "root";
       $password = "root";
       $database = "supermarketNotNull";
       $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    }
    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

    function conn()  
    {
      $servername = "localhost";
      $username = "root";
      $password = "root";
      $database = "supermarketNotNull";
      try {
          $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e)
      {
          echo "Connection failed: " . $e->getMessage();
      }

        return $conn;
 
    }
}
