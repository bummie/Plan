<?php
    set_include_path(dirname(__FILE__)."/../");

    
    require_once("config/beasla_config.php" ); 
    $cfg = new BCFG();
    require_once( "sql/SQL_read.php" ); 
    $SQL_R = new SQLRead();

    $TABLE_NAME = "beasla_skoleliste";
?>            


            <h3>Oppdater skoler</h3>
			<form action="../getters/get_update.php" method="post" target="_blank">
            <br />
            <b><h5>Skoledata</h5></b><br />
            Type_fra: <input name="skole_type_fra" type="number" value="0" /> <br>
            Type_til: <input name="skole_type_til" type="number" value="1" />

            <p>
                <h5>Database</h5><br/>
                
                Host: <input name="db_host" type="text" value="localhost" /> <br/>
                
                Brukernavn: <input name="db_brukernavn" type="text" value="" /> <br/>
                
                Passord: <input name="db_passord" type="password" value="" /> <br/>
                
                <br/>

                <b><h5>Databaseplassering</h5></b> <br/>
                Database: <input maxlength="50" name="db_database" type="text"/><br>
                
                <b><h5>Skole</h5></b> <br/>
                <select name="b_skoleliste">
                    <?php

                    $liste = $SQL_R->returnTable($cfg->getHost(), $cfg->getUsername(), $cfg->getPassword(), $cfg->getDatabase(), $TABLE_NAME);
                    
                    $i = 0;
                    $tabell_navn = "";
                    $tabell_skoid = "";
                    $tabell_skokode = "";

                    $tabell_navn_fin = "";
                    foreach ($liste as $rows => $row)
                    {

                        $i = 0;
                        foreach ($row as $col => $cell)
                        {
                        
                            switch($i)
                            {
                                case 1:
                                    $tabell_navn = $cell;
                                break;
                                case 2:
                                    $tabell_navn_fin = $cell;
                                break;
                                case 3:
                                    $tabell_skoid = $cell;
                                break;
                                case 4:
                                    $tabell_skokode = $cell;
                                break;
                            }

                            $i = $i + 1;  
                        } 

                        echo("<option value=".$tabell_navn."$".$tabell_skoid."$".$tabell_skokode.">".$tabell_navn_fin."</option>");
                    }   
                    ?>

                    
                </select>
                <p><input name="btn_updateschool" type="Submit" value="Oppdater" /></p>

        </form>		
