<html>
<head>
 <style>
        body {
            font: 14px/18px "HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #BCBCBC;
            background: #EFEFEF;
            padding: 20px 0;
        }
    footer {
   position:absolute;
   bottom:0;
   width:auto;
   height:30px;   /* Height of the footer */
   background: #transparent;
            }           
           
        h2 { color: #000000; font-size: 37px; line-height: 45px font-family: "Arial Black", "Arial Bold", Gadget, sans-serif; }
        h3 { font-weight: italic; color: #727272; font-size: 10px; line-height: 15px font-family: "Arial Black", "Arial Bold", Gadget, sans-serif; }

    </style>

<?php
    set_include_path(dirname(__FILE__)."/../");
    require_once( 'libs/katniss/katniss.php' );

    KAT::Init( true );
    DEBUG::Enable();

    // Write the current URL to the console
    DEBUG::Msg( "URL: ".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"] );

    KAT::IncludePHP( "libs/simple_html_dom.php" );
    KAT::IncludePHP( "config/beasla_config.php" ); 
    $cfg = new BCFG();
    DEBUG::Msg("Host:".$cfg->getHost());

    KAT::IncludePHP( "net/bea_grab.php" );
    //DEBUG::Msg(returnRefKode(72150, 546774));
    KAT::IncludePHP( "sql/SQL_write.php" ); 
    $SQL_W = new SQLWrite();


    DEBUG::Msg("[GETTER] - Ready");


    if (isset($_POST['btn_newschool'])) 
    {

        // Skoledata
         $skoleid = $_POST["skole_id"];
         $skolekode = $_POST["skole_kode"];    
        
         $skoletype_fra = $_POST["skole_type_fra"];
         $skoletype_til = $_POST["skole_type_til"];

        //Database
         $host = $_POST["db_host"]; 
         $brukernavn = $_POST["db_brukernavn"];  
         $passord = $_POST["db_passord"];  
         
         $database = $_POST["db_database"];  
         $tabell = $_POST["db_tabell"]; 

        //Ekstra
         $skolenavn = $_POST["ekstra_skolenavn"];  
         $skolefiks = $_POST["ekstra_fiks"]; 

    if($tabell != null || $tabell != "")
    {

    
    //Fikseting
         // Hente 
         if($skoletype_til < $skoletype_fra)
         {
            $skoletype_til = $skoletype_fra + 1;
         }

        $skolenavn = str_replace("æ","&aelig;", $skolenavn);
        $skolenavn = str_replace("Æ","&AElig;", $skolenavn);     
       
        $skolenavn = str_replace("ø","&oslash;", $skolenavn);     
        $skolenavn = str_replace("Ø","&Oslash;", $skolenavn);     
       
        $skolenavn = str_replace("å","&aring;", $skolenavn);     
        $skolenavn = str_replace("Å","&Aring;", $skolenavn);
    
        // Legg til skole i systemet, med elever.
        $SQL_W->skapSkoleTabell( $cfg->getHost(), $cfg->getUsername(), $cfg->getPassword(), $cfg->getDatabase(), $tabell, $skolenavn, $skoleid, $skolekode, $skolefiks, $skoletype_fra, $skoletype_til);
        DEBUG::Msg("[GETTER] - Added new school");


    }
            DEBUG::Msg("[GETTER] - Done");
  }     
?>
</head>
<body>

<h2>Getter_Ny_Skole</h2><br>
<a href="/beasla/cmd/"><strong>Tilbake</strong></a>


</body>
<footer>
<center>Bevster(c)2013</center>
</footer>
</html>