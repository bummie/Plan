<?php
    
    require_once($_SERVER['DOCUMENT_ROOT']."/beasla/config/beasla_config.php" ); 
    $cfg = new BCFG();
    require_once( $_SERVER['DOCUMENT_ROOT']."/beasla/sql/SQL_write.php" ); 
    $SQL_W = new SQLWrite();

?>    


<link rel="stylesheet" href="js/imgslider/css/demo.css" type="text/css" media="screen" />

<div class="ten columns">

    <?php 
        if($_COOKIE['c_id'] != null)
        { 

            if($_COOKIE['c_form'] != null)
            {?>
                <?php

                    // Statistikk
                    $SQL_W->addUserStats($cfg->getHost(), $cfg->getUsername(), $cfg->getPassword(), $cfg->getDatabase(),  $_COOKIE["c_id"]."$".$_COOKIE["c_navn"]."$".$_COOKIE["c_klasse"]."$".$_COOKIE["c_table"], $_SERVER['REMOTE_ADDR']);


                    if($_COOKIE['c_fiks'] == 'true')
                    {?>
                        <center>Skolen din viser kun den aktuelle uken</center>
                    <?php
                    }else{
                        ?>

                        <center><input name="knapp" src="images/timemenu/undo.png" height="30" width="30" id="btn_oppdater" onclick="oppdaterUke(document.getElementById('numb_uke').value); timeOut(this);" type="image" value="<Oppdater>"/></center>
                        <center>
                            <input name="knapp" src="images/timemenu/back.png" height="30" width="30" onclick="oppdaterUke(parseInt(document.getElementById('numb_uke').value) - 1); timeOut(this);" type="image" value="<Forrige>"/>
                            <input type="number" id="numb_uke" onkeydown="if (event.keyCode == 13) document.getElementById('btn_oppdater').click();" value="1" name="height" min="1" max="52">
                            <input name="knapp" src="images/timemenu/forward.png" height="30" width="30" onclick="oppdaterUke(parseInt(document.getElementById('numb_uke').value) + 1); timeOut(this);" type="image" value="<Neste>"/>
                        </center>

                    <?php
                    }
                    ?>

                <!-- BEGIN .wmuSlider -->
                <div class="wmuSlider timeplanBildr">
                    <center>
                    <div class="wmuSliderWrapper">
                        
                    <?php
                    $antD = 6;
                    if($_COOKIE['c_form'] == 0) $antD = 5;
                    if($_COOKIE['c_form'] == 1) $antD = 1;
                    if($_COOKIE['c_form'] == 2) $antD = 6;

                        for ($i=0; $i < $antD; $i++) { 
                            echo "<article><img id='p_bild_".$i."'name='".$i."' src='images/load/load.gif' /></article>";
                        }
                    ?>         
                    </div>
                    </center>
                      
                <!-- END .wmuSlider -->
                </div>
            <?php
            }else{
            ?>
            <center><a href='/webapp/?page=settings_tmp'><h3><span style="font-family:verdana,geneva,sans-serif;">Du har ikke satt opp en timeplansprofil</span></h3></a></center>
           <?php 
            }?>
        <?php 
        }else{
        ?>
        <center><a href='/webapp/?page=settings_prf'><h3><span style="font-family:verdana,geneva,sans-serif;">Du har ikke satt opp en profil</span></h3></a></center>
        <?php 
        }
        ?>

</div>

<!-- Scripts -->
    <script type="text/javascript" src="js/imgslider/modernizr.custom.min.js"></script>    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script src="js/imgslider/jquery.wmuSlider.js"></script>
    <script src="js/imgslider/jquery.wmuGallery.js"></script>
   	<script type="text/javascript" src="js/bea_tools/bea_planimg.js">> </script>
    <script type="text/javascript" src="js/bea_tools/bea_tool.js"></script>

    <script>
        $('.timeplanBildr').wmuSlider(); 
    </script>

    <script type="text/javascript">
        
        window.onload=function()
        {
            if(readCookie('c_fiks') == 'false')
            {
                if(readCookie('c_autouke') == 'false')
                {
                    if(readCookie('c_uke') == '1')
                    {
                        document.getElementById('numb_uke').value = new Date().getWeek();

                    }else{
                        document.getElementById('numb_uke').value = readCookie('c_uke');
                    }
                }else{
                    document.getElementById('numb_uke').value = new Date().getWeek();

                }
            }

            lastPlan(true);

        };

        function oppdaterUke(uke)
        {
            if(readCookie('c_uke') != uke)
            {   
                if(uke > 52) uke = 52;
                if(uke < 1) uke = 1;
                    createCookie('c_uke', uke, 60);
                    document.getElementById('numb_uke').value = readCookie('c_uke');
                    
                    lastPlan(false);
            }
            
        }

        function lastPlan(bol)
        {

            var VPLAN_FORM = readCookie('c_form');
            var VPLAN_DIMENSJON = readCookie('c_dimensjon');

            var VPLAN_SKOLEID = readCookie('c_skoleid');
            var VPLAN_STUDENTID = readCookie('c_id');

            var VPLAN_UKE = readCookie('c_uke');
            
            var VPLAN_xBREDDE = '1500';
            var VPLAN_yLENGDE = '600';

            var ANTALL_BILDER = 6;
            if(VPLAN_FORM == 0) ANTALL_BILDER = 5;
            if(VPLAN_FORM == 1) ANTALL_BILDER = 1;
            if(VPLAN_FORM == 2) ANTALL_BILDER = 6;

                    for (var i = 0; i < ANTALL_BILDER; i++) 
                    {
                        document.getElementById("p_bild_"+i).src="images/load/load.gif";
                        console.log("Lastet GIF: " + i);
                    };

            if(readCookie('c_fiks') == 'false')
            {
                if(bol)if(readCookie('c_autouke')) VPLAN_UKE = new Date().getWeek();
            }

            if(readCookie('c_fiks') == 'true') VPLAN_UKE = "";

            switch (VPLAN_DIMENSJON)
            {
                case '0':
                    VPLAN_xBREDDE = '1500';
                    VPLAN_yLENGDE = '600';
                    console.log("Case one " + VPLAN_yLENGDE + " " + VPLAN_xBREDDE);
                break;
                
                case '1':
                    VPLAN_xBREDDE = '1000';
                    VPLAN_yLENGDE = '400';

                break;
                
                case '2':
                    VPLAN_xBREDDE = '2100';
                    VPLAN_yLENGDE = '800';

                break;

                default:
                    var sArr = VPLAN_DIMENSJON.split('$');
                    VPLAN_xBREDDE = sArr[0];
                    VPLAN_yLENGDE = sArr[1];

                break;
            }

       /* if(VPLAN_yLENGDE != null || VPLAN_xBREDDE != null)
        {
            //var imgArray = returnPlanArray(VPLAN_SKOLEID, VPLAN_STUDENTID, VPLAN_UKE, VPLAN_xBREDDE, VPLAN_yLENGDE, VPLAN_FORM, VPLAN_DIMENSJON );
           for (var i = 0; i < ANTALL_BILDER; i++) 
            {
                document.getElementById("p_bild_"+i).src=returnPlanImage(i, VPLAN_SKOLEID, VPLAN_STUDENTID, VPLAN_UKE, VPLAN_xBREDDE, VPLAN_yLENGDE, VPLAN_FORM, VPLAN_DIMENSJON );
                    alert(i);
                }

        }*/

         if(VPLAN_yLENGDE != null || VPLAN_xBREDDE != null)
            var imgArray = returnPlanArray(VPLAN_SKOLEID, VPLAN_STUDENTID, VPLAN_UKE, VPLAN_xBREDDE, VPLAN_yLENGDE, VPLAN_FORM, VPLAN_DIMENSJON );
       
        if(imgArray != null)
        {

            planMages = new Array(); 

        	for (var li = 0; li < ANTALL_BILDER; li++) 
        	{        		
                
                planMages[li] = document.getElementById("p_bild_"+li);

                planMages[li].onload = function()
                {
                    console.log('Loaded Image');
                    //document.getElementById("p_bild_"+i).src=imgArray[i];

                }
                    
                planMages[li].onerror = function()
                {
                     console.log('Failed Loading Image: ' + this.name);
                     this.src="images/load/load.gif";
                     loadImage(this.name, imgArray[this.name]);
                }
                
                planMages[li].src = imgArray[li];

                //setTimeout(function(){alert("Hello " + a)}, 300);
                //alert(i);
        	}
        }else{
        	alert("Kunne ikke laste planen");
        }
    }

    function loadImage(pos, url)
    {
        console.log('Retrying image load: ' + pos + ', ' + url);
        document.getElementById("p_bild_"+pos).src = url;
        console.log('Done');
    }

       
    function timeOut(obj)
    {
        obj.disabled = true;
        setTimeout(function() {
        obj.disabled = false;
        }, 2000);       
    }

    </script>