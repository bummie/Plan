<?php

set_include_path(dirname(__FILE__)."/../");
require_once( 'net/bea_grab.php' );

class SQLWrite
{


 // Config - Bevster 2013
    public $TABLE_CONSTANT;
    public $TABLE_CONSTANT_SEARCH;
    public $TABLE_CONSTANT_USERS;


//Database
  function __construct()
  {
      $this->TABLE_CONSTANT = 'beasla_skole_';
      $this->TABLE_CONSTANT_SEARCH = 'stats_search';
      $this->TABLE_CONSTANT_USERS = 'stats_users';


  }

  
  //Statistikk
  public function addUserStats($host, $brukernavn, $passord, $database, $values, $ip)
  {

    $valueList = explode('$', $values);


    if(!$this->tableExist($host, $brukernavn, $passord, $database, $this->TABLE_CONSTANT_USERS))
      {
        try{
        $db_con = new PDO(sprintf('mysql:dbname=%s;host=%s', 
                  $database,
                  $host),
                  $brukernavn, 
                  $passord);
        //UPDATE `Seb` SET `amount`= `amount` + 1 WHERE `search`='seb'

        // Turn on exceptions
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $skapeSokeTabell = $db_con->prepare("CREATE TABLE `".$this->TABLE_CONSTANT_USERS."` (`id` varchar(120), PRIMARY KEY(`id`), `besok` int(70), `navn` varchar(120), `klasse` varchar(50), `tabell` varchar(75), `ip` varchar(50), `last_seen` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);");
        $skapeSokeTabell->execute();
      } catch(PDOException $e) {
            echo("ERROR - userTabell: ".$e->getMessage());
      }
    }

    try{
        $db_con = new PDO(sprintf('mysql:dbname=%s;host=%s', 
                  $database,
                  $host),
                  $brukernavn, 
                  $passord);
        //UPDATE `Seb` SET `amount`= `amount` + 1 WHERE `search`='seb'

        // Turn on exceptions
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $timeZone = $db_con->prepare("SET time_zone = '+07:00'");
        $timeZone->execute();
        $settInnSok = $db_con->prepare("INSERT INTO `".$this->TABLE_CONSTANT_USERS."` ( `id`, `besok`, `navn`, `klasse`, `tabell`, `ip`, `last_seen`) VALUES ( '".$valueList[0]."','1', '".$valueList[1]."','".$valueList[2]."','".$valueList[3]."', '".$ip."', null) ON DUPLICATE KEY UPDATE `ip`='".$ip."', `besok`= `besok` + 1;");
        $settInnSok->execute();
      
      } catch(PDOException $e) {
            echo("ERROR - insertUser: ".$e->getMessage());
      }


  }


	public function addSearchResult($host, $brukernavn, $passord, $database, $search, $skole, $resultat, $ip)
  {

      if(!$this->tableExist($host, $brukernavn, $passord, $database, $this->TABLE_CONSTANT_SEARCH))
      {
        try{
        $db_con = new PDO(sprintf('mysql:dbname=%s;host=%s', 
                  $database,
                  $host),
                  $brukernavn, 
                  $passord);
        //UPDATE `Seb` SET `amount`= `amount` + 1 WHERE `search`='seb'

        // Turn on exceptions
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $skapeSokeTabell = $db_con->prepare("CREATE TABLE `".$this->TABLE_CONSTANT_SEARCH."` (`search` varchar(120), PRIMARY KEY(`search`), `amount` int(75), `skole` varchar(120),`resultat` int(75), `ip` varchar(120), `recent_search` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);");
        $skapeSokeTabell->execute();
      } catch(PDOException $e) {
            echo("ERROR - SokeTabell: ".$e->getMessage());
      }
    }
        try{
        $db_con = new PDO(sprintf('mysql:dbname=%s;host=%s', 
                  $database,
                  $host),
                  $brukernavn, 
                  $passord);
        //UPDATE `Seb` SET `amount`= `amount` + 1 WHERE `search`='seb'

        // Turn on exceptions
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $settInnSok = $db_con->prepare("SET time_zone = '+07:00'; INSERT INTO `".$this->TABLE_CONSTANT_SEARCH."` ( `search`, `amount`, `skole`, `resultat`, `ip`, `recent_search`) VALUES ( '".$search."','1', '".$skole."', '".$resultat."', '".$ip."',  null) ON DUPLICATE KEY UPDATE `skole`= '".$skole."', `resultat`= '".$resultat."', `ip`= '".$ip."', `amount`= `amount` + 1;");
        $settInnSok->execute();
      
      } catch(PDOException $e) {
            echo("ERROR - insertTabell: ".$e->getMessage());
      }
    
  }


  //Skoleskapelse og oppdateringer
  public function skapSkoleTabell($host, $brukernavn, $passord, $database, $tabell, $skolenavn, $skoleid, $skolekode, $fiks, $type_fra, $type_til)
 {
 	$tabell_navn = $this->TABLE_CONSTANT.$tabell;


	if(!$this->tableExist($host, $brukernavn, $passord, $database, $tabell_navn)){
   		DEBUG::Msg( "Tabell eksisterer ikke, skaper en ny med navn: " . $tabell_navn);

			// Koble til database
			try{
				$db_con = new PDO(sprintf('mysql:dbname=%s;host=%s', 
                  $database,
                  $host),
                  $brukernavn, 
                  $passord);

        // Turn on exceptions
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $skapSkoleTabellen = $db_con->prepare("CREATE TABLE `".$tabell_navn."` (`keyID` int NOT NULL AUTO_INCREMENT, PRIMARY KEY(`keyID`), `StudentID` varchar(36), `Klasse` varchar(45), `Navn` varchar(45), `Type` varchar(20), `Tilg` varchar(6))");
		    $skapSkoleTabellen->execute();
   		DEBUG::Msg( "Skapte tabell: " . $tabell_navn. " i " . $database);

	        
        $this->skapSkoleListe($host, $brukernavn, $passord, $database, $tabell, $skolenavn, $skoleid, $skolekode, $fiks);
        
        // Forloop

        for ($i = $type_fra; $i <= $type_til; $i++) 
        {
          $this->addStudent($host, $brukernavn, $passord, $database, $tabell, grabStudentList(returnRefKode($skoleid, $skolekode), $skoleid, $skolekode, $i));
          DEBUG::Msg("Student lagt til " . $i);
            
        } 


    			} catch(PDOException $e) {
    				DEBUG::Msg("ERROR - skapSkoleTabell: ".$e->getMessage());
    			}
  }else{

    DEBUG::Msg( $tabell_navn . " esksisterer allerede, skaper ikke ny!");
    $this->skapSkoleListe($host, $brukernavn, $passord, $database, $tabell, $skolenavn, $skoleid, $skolekode, $fiks);

   }
    $db_con = null;
  }


public function addStudent($host, $brukernavn, $passord, $database, $tabell, $studentListe)
{
 	$tabell_navn = $this->TABLE_CONSTANT.$tabell;
 	$antallStudenter = 0;
  $stu_tilg = '1';
	
	if($studentListe != null || $studentListe == "" || $studentListe != 0)
	{

		
		try{
			$db_con = new PDO(sprintf('mysql:dbname=%s;host=%s', 
                  $database,
                  $host),
                  $brukernavn, 
                  $passord);

		$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$settStuData = $db_con->prepare("INSERT INTO `".$database."`.`".$tabell_navn."` (`keyID`, `StudentID`, `Klasse`, `Navn`, `Type`, `Tilg`) VALUES (NULL, :stuID, :stuKlasse, :stuNavn, :stuType, :stuTil);");
		
		
     
		foreach ($studentListe as $rows => $row) 
		{
			$antallStudenter = $antallStudenter + 1;
           $i = 0;
            foreach ($row as $col => $cell) 
            {
           if($i == 0) $stu_id = $cell;
           if($i == 1) $stu_klasse = $cell;
           if($i == 2) $stu_navn = $cell;
           if($i == 3) $stu_type = $cell;

           $i = $i + 1;
            }   

      //Bindings
			$settStuData->bindParam(':stuID', $stu_id, PDO::PARAM_STR);
			$settStuData->bindParam(':stuKlasse', $stu_klasse, PDO::PARAM_STR);
			$settStuData->bindParam(':stuNavn', $stu_navn, PDO::PARAM_STR);
			$settStuData->bindParam(':stuType', $stu_type, PDO::PARAM_STR);
			$settStuData->bindParam(':stuTil', $stu_tilg, PDO::PARAM_STR);
		
			$settStuData->execute();
          }   

          DEBUG::Msg($antallStudenter . " studenter lagt til ".$tabell_navn);

    } catch(PDOException $e) {
    DEBUG::Msg( 'ERROR - addStudent: ' . $e->getMessage());
    }
  }else{

  	DEBUG::Msg("ERROR - addStudent: Studenlist array is empty");
  }
}


private function skapSkoleListe($host, $brukernavn, $passord, $database, $tabell, $skolenavn, $skoleid, $skolekode, $fiks)
{
 	$tabell_navn = $this->TABLE_CONSTANT.$tabell;

	$skoleListe = 'beasla_skoleliste';

try{
$db_con = new PDO(sprintf('mysql:dbname=%s;host=%s', 
                  $database,
                  $host),
                  $brukernavn, 
                  $passord);

		$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Preparing
		$skapTabell = $db_con->prepare("CREATE TABLE `".$skoleListe."` (keyID int NOT NULL AUTO_INCREMENT, PRIMARY KEY(keyID), Skole_tabellnavn varchar(45), Skole_navn varchar(45), SkoleID varchar(25), SkoleKode varchar(25), Fiks varchar(2))");
		$settData = $db_con->prepare("INSERT INTO `".$database."`.`".$skoleListe."` (`keyID`, `Skole_tabellnavn`, `Skole_navn`, `SkoleID`, `SkoleKode`, `Fiks`) VALUES (NULL, :tb, :sn, :si, :sk, :fi);");
		
		//Bindings
		$settData->bindParam(':tb', $tabell_navn, PDO::PARAM_STR);
		$settData->bindParam(':sn', $skolenavn, PDO::PARAM_STR);
		$settData->bindParam(':si', $skoleid, PDO::PARAM_STR);
		$settData->bindParam(':sk', $skolekode, PDO::PARAM_STR);
		$settData->bindParam(':fi', $fiks, PDO::PARAM_STR);

		DEBUG::Msg( "Forberedt dataene"); 

        // Turn on exceptions
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(!$this->tableExist($host, $brukernavn, $passord, $database, $skoleListe)){
           
            DEBUG::Msg( "Tabell eksisterer ikke, skaper en ny med navn: " . $skoleListe );
            $skapTabell->execute();

            DEBUG::Msg(  "Legger til data i skolelisten fra " . $tabell_navn);
            $settData->execute();
            DEBUG::Msg( "Lagt til " . $tabell_navn . " til skolelisten!");


        }else{
            DEBUG::Msg( $skoleListe . " eksisterer allerede, skaper ikke ny!");

            	$result = $db_con->query("SELECT `keyID` FROM ".$skoleListe." WHERE `Skole_tabellnavn` = '".$tabell_navn."' LIMIT 0, 30 ")->fetch(PDO::FETCH_ASSOC);
				if($result == 0) {

						DEBUG::Msg(  "Legger til data i skolelisten fra " . $tabell_navn);
           				$settData->execute();
            			DEBUG::Msg( "Lagt til " . $tabell_navn . " til skolelisten!");

				} else {
						DEBUG::Msg(  "Data fra " . $tabell_navn . " eksisterer allerede!");
				}

  }

    } catch(PDOException $e) {
    DEBUG::Msg( 'ERROR - skapSkoleListe: ' . $e->getMessage());
    }

    $db_con = null;
}


private function tableExist($host, $brukernavn, $passord, $database, $tabell)
{
  $exist = true;

  // Aapne mot database
  try{
    $db_con = new PDO(sprintf('mysql:dbname=%s;host=%s', 
                  $database,
                  $host),
                  $brukernavn, 
                  $passord);

        // Turn on exceptions
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db_con->query('SELECT 1 from ' . $tabell);

    } catch(PDOException $e) {
    //DEBUG::Msg( 'ERROR: ' . $e->getMessage());
    //DEBUG::Msg( '<EXISTENCE>: ' . $tabell. ' does not exist.');
    $exist = false;
    }
    
    $db_con = null;

	return $exist;
}


  public function updateSchool($host, $brukernavn, $passord, $database, $tabell, $skoleid, $skolekode, $type_fra, $type_til )
  {


    // Aapne mot database
  try{
    $db_con = new PDO(sprintf('mysql:dbname=%s;host=%s', 
                  $database,
                  $host),
                  $brukernavn, 
                  $passord);

        // Turn on exceptions
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      if($this->emptyTable($host, $brukernavn, $passord, $database, $tabell))
      {

        $tabell_stu = str_replace($this->TABLE_CONSTANT,"", $tabell);
        for ($i = $type_fra; $i <= $type_til; $i++) 
        {
          $this->addStudent($host, $brukernavn, $passord, $database, $tabell_stu, grabStudentList(returnRefKode($skoleid, $skolekode), $skoleid, $skolekode, $i));
          DEBUG::Msg("Student lagt til " . $i);
        }
      }else{
        DEBUG::Msg("[ERROR_updateSchool]: Noe gikk galt med emptying, norglish");
      }
        


    } catch(PDOException $e) {
    DEBUG::Msg( '[ERROR_updateSchool]: ' . $e->getMessage());
    }
    
    $db_con = null;

  }


  private function emptyTable($host, $brukernavn, $passord, $database, $tabell)
  {
    try{
    $db_con = new PDO(sprintf('mysql:dbname=%s;host=%s', 
                  $database,
                  $host),
                  $brukernavn, 
                  $passord);

        // Turn on exceptions
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       

        $emptytabell = $db_con->prepare("TRUNCATE " . $tabell);
        $emptytabell->execute();

        DEBUG::Msg("[EMPTER] Truncated table ".$tabell);

        return true;
    } catch(PDOException $e) {
    DEBUG::Msg( '[ERROR_emptyTable]: ' . $e->getMessage());
    return false;
    }
    
    $db_con = null;
  }


}