<?php
set_include_path(dirname(__FILE__)."/../");

class SQLRead
{

 // Config - Bevster 2013
    public $TABLE_CONSTANT;
  

//Database
  function __construct()
  {
     $this->TABLE_CONSTANT = 'beasla_skole_';
    
  }


  public function returnTable($host, $brukernavn, $passord, $database, $tabell)
  {
    $tabell_full = null;
    // Aapne mot database
  try{
    $db_con = new PDO(sprintf('mysql:dbname=%s;host=%s', 
                  $database,
                  $host),
                  $brukernavn, 
                  $passord);

        // Turn on exceptions
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //"SELECT * FROM `beasla_skoleliste` LIMIT 0, 30 ";

        $readData = $db_con->prepare("SELECT * FROM `".$tabell."`");
        $readData->execute();
        $tabell_full = $readData->fetchAll(PDO::FETCH_ASSOC);


    } catch(PDOException $e) {
    echo( '[ERROR_returnTable]: ' . $e->getMessage());
    }
    
    $db_con = null;

    return $tabell_full;
  }

  public function displayTable($liste)
  {
       
       $aY = -1; // Array Y lengde
       $aX = -1; // Array X lengde

        echo "<table border='1'>";
        foreach ($liste as $rows => $row) {
          $aY = count($liste);

            echo "<tr>";
              foreach ($row as $col => $cell) {
              $aX = count($row);              
                echo "<td>" . $cell . "</td>";
              }   
            echo "</tr>";
          }   
            echo "</table>";
  }


  public function searchSchool($host, $brukernavn, $passord, $database, $tabell, $search, $type)
  {
      $tabell_full = null;

      $fSearch = str_replace('$', '&', $search);


    // Aapne mot database
  try{
    $db_con = new PDO(sprintf('mysql:dbname=%s;host=%s', 
                  $database,
                  $host),
                  $brukernavn, 
                  $passord);

        // Turn on exceptions
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //"SELECT * FROM `beasla_skole_lorenskog` WHERE `Navn` LIKE \'%lund%\'";

        $readData = $db_con->prepare("SELECT * FROM `".$tabell."` WHERE `".$type."` LIKE '%".$fSearch."%'");
        $readData->execute();
        $tabell_full = $readData->fetchAll(PDO::FETCH_ASSOC);


    } catch(PDOException $e) {
    echo('[ERROR_searchSchool]: ' . $e->getMessage());
    }
    
    $db_con = null;

    return $tabell_full;
  }



}