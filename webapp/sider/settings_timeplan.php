<script type="text/javascript" src="js/bea_tools/bea_tool.js"></script>
<div class="container">
<div class="sixteen columns">

    <h1><span style="font-family:verdana,geneva,sans-serif;">Innstillinger</span></h1>

    <b>Form</b>
    <select id="sel_form" name="bs_formvalg">
        <option id="f_0" value="0">[Mobil] Dag for dag</option>
        <option id="f_1" value="1">[PC] Ukevis</option>
        <option id="f_2" value="2">Begge</option>
    </select>
    
    <b>Dimensjoner</b>
    <select id="sel_dimen" name="bs_dimensjonsvalg">
        <option id="d_0" value="0">Standard</option>
        <option id="d_1" value="1">Lav oppløsning</option>
        <option id="d_2" value="2">Høy oppløsning</option>
    </select>
    <input type="checkbox" id="dim_chk" value="dim" onclick="document.getElementById('c_w').disabled=(this.checked)?0:1; document.getElementById('c_h').disabled=(this.checked)?0:1">Egendefinert<br>
    <input type="number" id="c_w" disabled="1" value="1500" name="width" min="250" max="5000">Bredde<br>
    <input type="number" id="c_h" disabled="1" value="600" name="height" min="250" max="5000">Lengde<br><br>

    <b>Annet</b><br>
    <input type="checkbox" id="chk_autoweek" value="dim" onclick="">Automatisk uke<br>


    <input name="btn_lagre_time" onclick="saveData();" type="button" value="Lagre"/>

</div>    
</div> 


<script type="text/javascript">

        window.onload=function()
        {
            if(readCookie('c_form'))
                switch (readCookie('c_form'))
                {
                    case '0':
                        document.getElementById('f_0').selected = true;
                    break;
                    
                    case '1':
                        document.getElementById('f_1').selected = true;
                    break;
                    
                    case '2':
                        document.getElementById('f_2').selected = true;
                    break;

                    default:
                    break;
                }

                if(readCookie('c_dimensjon'))
                switch (readCookie('c_dimensjon'))
                {
                    case '0':
                        document.getElementById('d_0').selected = true;
                    break;
                    
                    case '1':
                        document.getElementById('d_1').selected = true;
                    break;
                    
                    case '2':
                        document.getElementById('d_2').selected = true;
                    break;

                    default:
                    break;
                }
    

            if(readCookie('c_autouke') != null) document.getElementById('chk_autoweek').checked = readCookie('c_autouke');

        };


function saveData()
{
    var V_FORM = returnTable('sel_form');
    var V_DIMEN = "0";
    var V_AUKE = document.getElementById('chk_autoweek').checked;

    if(document.getElementById('dim_chk').checked)
    {
        V_DIMEN = document.getElementById('c_w').value + '$' + document.getElementById('c_h').value;
    }else{
        V_DIMEN = returnTable('sel_dimen');
    }
    saveTimeplanData(V_FORM, V_DIMEN, V_AUKE);

   // alert(new Date().getWeek());
}


</script>   
