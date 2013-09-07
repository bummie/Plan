// Verktoy for et enklere liv, blink blink ;9


	// Returnere verdi fra dropdownlistting
	function returnTable(elemtid)
	{
		var e = document.getElementById(elemtid);
	if(e != null)
	{
		var table = e.options[e.selectedIndex].value;
		return table;
	}else{
		alert("null");
		return null;
	}	
		
	}

	// Legger til GET verdiene til adressen
	function setGet(table, search, type)
	{
		if(table != "" || search != "" || type != "")
		{
			var tableArray = table.split('$');
			var fSearch = fixSearch(search);
            document.location.search = document.location.search + "&table=" +tableArray[0] + "&scid="+tableArray[1] + "&tfiks="+tableArray[2] +"&search="+fSearch+"&type="+type;
		}else{
			alert("Oops..");
		}
			
    }


    function fixSearch(search)
	{

        
        if(!String.prototype.trim)
        {  
            String.prototype.trim = function ()
            {  
                return this.replace(/^\s+|\s+$/g,'');  
            };  
        }

		var fixed_string = "";
            fixed_string = search.replace("æ","$#230;");
            fixed_string = fixed_string.replace("Æ","$#198;");
            fixed_string = fixed_string.replace("ø","$#248;");
            fixed_string = fixed_string.replace("Ø","$#216;");
            fixed_string = fixed_string.replace("å","$#229;");
            fixed_string = fixed_string.replace("Å","$#197;");
            fixed_string = fixed_string.trim();

            return fixed_string;
    }
    

    function saveStudentData(verdi)
    {
    	var VALUE = verdi;
    	if(verdi != null)
    	{
    	var DAGER = 60;

    	//Kjeksnavn
    	var V_NAVN = "c_navn";
    	var V_KLASSE = "c_klasse";
    	var V_ID = "c_id";
    	var V_TYPE = "c_type";
    	var V_SKOLEID = "c_skoleid";
    	var V_SKOLETABELL = "c_table";
        var V_FIKS = "c_fiks";
    	var V_UKE = "c_uke";

    	var ValueArray = VALUE.split('$');

        var vfiks = false;
        
        if(ValueArray[6] != ""){
            vfiks = true;
        }else{
            vfiks = false;
        }

    	createCookie(V_NAVN, ValueArray[2].split('_').join(' '), DAGER); //Navn
    	createCookie(V_KLASSE, ValueArray[1], DAGER); //Klasse
    	createCookie(V_ID, ValueArray[0], DAGER); //ID
    	createCookie(V_TYPE, ValueArray[3], DAGER); //Type
    	createCookie(V_SKOLEID, ValueArray[4], DAGER); //Skoleid
    	createCookie(V_SKOLETABELL, ValueArray[5], DAGER); //Skoletabell
        createCookie(V_FIKS, vfiks, DAGER); //Fiks
    	createCookie(V_UKE, "1", DAGER); //Uke
    	}
    }

    function printStoredData()
    {

    	if(readCookie("c_navn") != null )
    	{
    		document.write("<h3><span style='font-family:verdana,geneva,sans-serif;'>Profildata</span></h3>");
    		document.write("<span style='font-family:Verdana;font-weight:bold;''>Navn: </span>" + readCookie('c_navn') + "<br>");
    		document.write("<span style='font-family:Verdana;font-weight:bold;''>Klasse: </span>" + readCookie('c_klasse') + "<br>");
    		document.write("<span style='font-family:Verdana;font-weight:bold;''>ID: </span>" + readCookie('c_id') + "<br>");
    		document.write("<span style='font-family:Verdana;font-weight:bold;''>Type: </span>" + readCookie('c_type') + "<br>");
    		document.write("<span style='font-family:Verdana;font-weight:bold;''>SkoleID: </span>" + readCookie('c_skoleid') + "<br>");

    	}
    }


    function saveTimeplanData(form, dimensjoner, autoUke)
    {
    	if(form != null)
    	{
    	var DAGER = 60;

    	//Kjeksnavn
    	var V_FORM = "c_form";
    	var V_DIMENSJON = "c_dimensjon";
    	var V_AUTOUKE = "c_autouke";
    	
    	createCookie(V_FORM, form, DAGER); //Form
    	createCookie(V_DIMENSJON, dimensjoner, DAGER); //Dimensjoner
    	createCookie(V_AUTOUKE, autoUke, DAGER); //Autouke
    		alert('Lagret data!');
    	}
    }



    // quirksmode.org, takk takk
	function createCookie(name,value,days)
	{
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
	}	

	function readCookie(name) 
	{
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
	}

	function eraseCookie(name) 
	{
	createCookie(name,"",-1);
	}

	Date.prototype.getWeek = function() { 
	    var determinedate = new Date(); 
	    determinedate.setFullYear(this.getFullYear(), this.getMonth(), this.getDate()); 
	    var D = determinedate.getDay(); 
	    if(D == 0) D = 7; 
	    determinedate.setDate(determinedate.getDate() + (4 - D)); 
	    var YN = determinedate.getFullYear(); 
	    var ZBDoCY = Math.floor((determinedate.getTime() - new Date(YN, 0, 1, -6)) / 86400000); 
	    var WN = 1 + Math.floor(ZBDoCY / 7); 
	    return WN; 
	}