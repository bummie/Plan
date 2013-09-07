<?php
    
    require_once($_SERVER['DOCUMENT_ROOT']."/beasla/config/beasla_config.php" ); 
    $cfg = new BCFG();
    require_once( $_SERVER['DOCUMENT_ROOT']."/beasla/sql/SQL_read.php" ); 
    $SQL_R = new SQLRead();
?> 

<h1>Statistikk</h1>


<?php 
echo("<h3>Søk</h3>");
$SQL_R->displayTable($SQL_R->returnTable($cfg->getHost(), $cfg->getUsername(), $cfg->getPassword(), $cfg->getDatabase(), "stats_search"));

echo("<h3>Brukere</h3>");
$SQL_R->displayTable($SQL_R->returnTable($cfg->getHost(), $cfg->getUsername(), $cfg->getPassword(), $cfg->getDatabase(), "stats_users"));
?>