<?php
    
    require_once($_SERVER['DOCUMENT_ROOT']."/beasla/config/beasla_config.php" ); 
    $cfg = new BCFG();
    require_once( $_SERVER['DOCUMENT_ROOT']."/beasla/sql/SQL_read.php" ); 
    $SQL_R = new SQLRead();
    require_once( $_SERVER['DOCUMENT_ROOT']."/beasla/sql/SQL_write.php" ); 
    $SQL_W = new SQLWrite();

    $TABLE_NAME = "beasla_skoleliste";
?>            
<script type="text/javascript" src="js/bea_tools/bea_tool.js"></script>

<?php

	// Finner ut om brukeren onsker aa soke eller velge student for aa lagre.
	if($_GET['table'] != '' && $_GET['search'] != '' && $_GET['type'] != '')
	{ 
        ?>
		<div class="container">

		<div class="sixteen columns">
			
			<h1><span style="font-family:verdana,geneva,sans-serif;">Innstillinger</span></h1>


			<p><select id="bs_stuid" name="bs_studentliste">
            <?php
                //Statistikk
     			$liste = $SQL_R->searchSchool($cfg->getHost(), $cfg->getUsername(), $cfg->getPassword(), $cfg->getDatabase(), $_GET['table'], $_GET['search'], $_GET['type']);
                $SQL_W->addSearchResult($cfg->getHost(), $cfg->getUsername(), $cfg->getPassword(), $cfg->getDatabase(), $_GET['search'], $_GET['table'], count($liste), $_SERVER['REMOTE_ADDR'] );

                 if($liste != null || $liste > 0 || $liste != ""  )
                 {


                    $i = 0;
                    
                    // Verdier
                    $stu_id = "";
                    $stu_klasse = "";
                    $stu_navn = "";
                    $stu_type = "";

                    $select_navn = "";

                    foreach ($liste as $rows => $row)
                    {

                        $i = 0;
                        foreach ($row as $col => $cell)
                        {
                        

                            switch($i)
                            {
                                case 1:
                                    $stu_id = $cell;
                                break;
                                case 2:
                                    $stu_klasse = $cell;
                                break;
                                case 3:
                                    $stu_navn = $cell;
                                break;
                                case 4:
                                    $stu_type = $cell;
                                break;
                                
                               
                            }

                            $i = $i + 1;  
                        } 

                        switch($stu_type)
                            {
                                case 'Annet':
                                    $select_navn = $stu_navn;
                                break;
                                case 'Klasse':
                                    $select_navn = $stu_klasse;
                                break;
                                case 'Student':
                                    $select_navn = $stu_navn;
                                break;
                                default:
                                    $select_navn = "Feilmelding :)";
                                break;
                               
                            }

                        echo("<option value=".$stu_id."$".$stu_klasse."$".str_replace(' ', '_', trim($stu_navn))."$".$stu_type."$".$_GET['scid']."$".$_GET['table']."$".$_GET['tfiks'].">".$select_navn."</option>");
                    }

                    }else{
                    	echo("<option value=null>Søket gav ingen resultater</option>");  
                    }
                    ?>

                    
                </select></p>

                <input name="btn_lagre" onclick="saveStudentData(returnTable('bs_stuid')); setText('<h4>Lagret data for:</h4> ' + readCookie('c_navn') + ' <h4>Klasse: </h4>' + readCookie('c_klasse'), 'txt_save');" type="button" value="Lagre"/>
		        <div id="txt_save"></div>

			
		</div>
		</div><!-- container -->
	<?php }else{ ?>

		<div class="container">

		<div class="sixteen columns">
			
			<h1><span style="font-family:verdana,geneva,sans-serif;">Innstillinger</span></h1>
		
			<p><select id="bs_id_skoleliste" name="bs_skoleliste">
                    <?php

                    $liste = $SQL_R->returnTable($cfg->getHost(), $cfg->getUsername(), $cfg->getPassword(), $cfg->getDatabase(), $TABLE_NAME);
                    
                    $i = 0;
                    $tabell_navn = "";
                    $tabell_navn_fin = "";
                    $tabell_skoleid = "";
                    $tabell_fiks = "";


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
                                    $tabell_skoleid = $cell;
                                break;
                                case 5:
                                    $tabell_fiks = $cell;
                                break;
                               
                            }

                            $i = $i + 1;  
                        } 

                        echo("<option value=".$tabell_navn."$".$tabell_skoleid."$" . $tabell_fiks. ">".$tabell_navn_fin."</option>");
                    }   
                    ?>

                    
                </select></p>
		
		<p><input size="35" id="s_text" type="text" placeholder="S&oslash;k her..." onkeydown="if (event.keyCode == 13) document.getElementById('btn_id_search').click()" /><input name="btn_search" id="btn_id_search"onclick="searchBtn();" type="button" value="S&oslash;k"/>

			<input name="s_type" id="ch_navn" type="radio" value="Navn" checked />Navn
			<input name="s_type" id="ch_klasse" type="radio" value="Klasse" />Klasse
			<input name="s_type" id="ch_id" type="radio" value="StudentID" />ID
        </p>
		
		<p><span style="font-family:verdana,geneva,sans-serif;">S&oslash;k gjerne med deler av navnet for ett bedre resultat.<br> Eksempel: I stedet for &quot;</span><span style="color: rgb(51, 51, 51); font-family: arial, helvetica, clean, sans-serif; font-size: 13px; line-height: 16px;">Emmanuelle B&eacute;art</span><span style="font-family: verdana, geneva, sans-serif;">&quot;, s&oslash;k &quot;</span><span style="color: rgb(51, 51, 51); font-family: arial, helvetica, clean, sans-serif; font-size: 13px; line-height: 16px;">Emma&quot;.</span></p>

		<br />

        <script type="text/javascript">printStoredData();</script>

		</div>
</div><!-- container -->
<?php
	} 
?>

<script>


        function setText(text,id)
        {
            document.getElementById(id).innerHTML = text;
        }

    
        function searchBtn()
        {
            var listValue = document.getElementById('bs_id_skoleliste').value;

            if(document.getElementById('ch_navn').checked) {
                    setGet(listValue, document.getElementById('s_text').value,'Navn');
            }else if(document.getElementById('ch_klasse').checked){
                    setGet(listValue, document.getElementById('s_text').value,'Klasse');
            }else if(document.getElementById('ch_id').checked){
                    setGet(listValue, document.getElementById('s_text').value,'Annet');

            }
        }
    </script>