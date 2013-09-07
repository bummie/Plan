<?php  

function returnRefKode($skoleid, $skolekode){
            // Vi blir sendt videre av Novakarene fra Svenskelandet. For aa komme oss forbi denne stumpen tar vi med oss id'en og slikt og slikt
            // Det funker, ikke spor hvordan. Det bare gjor det!
        $htmla = file_get_html('http://www.novasoftware.se/webviewer/MZDesign1.aspx?schoolid=' . $skoleid.'&code=' . $skolekode);

        foreach($htmla->find('a') as $element) 
        DEBUG::Msg('Webview-href: '. $element->href);

        $htmla->clear();

        $webid = substr($element->href, 18, 24); 
        DEBUG::Msg( 'Webview-ID: ' . $webid);
        
    return $webid;
}


        
function grabStudentList($refkode, $skolensid, $skolenskode, $skolenstype){
            global $skoleid, $skolekode, $skoletype, $host, $brukernavn, $passord, $database, $tabell, $skoleid, $skolekode;

            $adresse = 'http://www.novasoftware.se/webviewer/(S(' . $refkode . '))/MZDesign1.aspx?schoolid=' . $skolensid.'&code=' . $skolenskode . '&type=' . $skolenstype;
            $html = file_get_html($adresse);

            DEBUG::Msg( "[STUDENT_GRABBER]: Starter");

            $opt = $html->find('option');
          
            $studentListe = array();    

            for ($i = 0; $i < count($opt); $i++) {
               $element = $opt[$i];
                $value = $element->value;
                $content = $element->innertext;

             if(strlen($value) > 36){

                // Fjerner brakkene fra ID'en
                $nValue = substr($value, 1, 36);

                    // Finner forste tomrom for aa skille mellom klasse og navn.
                    $pos = strpos($content, ' ');
                    if($pos === false){
                     //Vedkommende har ikke et navn, stor sansynelighet for en klasse eller et rom.
                       $klasse = $content;
                       $navn = "null";
                       $type = "Klasse";

                                 $studentListe[] = array(
                                    "student_id"=>$nValue,
                                    "student_klasse"=>$klasse,
                                    "student_navn"=>$navn,
                                    "student_type"=>$type);


                    }else{
                  
                     // Vedkommende tilhorer en klasse
                        if($content{$pos-1} != ','){
                             $klasse = substr($content, 0, $pos);
                             $navn = substr($content, $pos);
                             $type = "Student";

                                $studentListe[] = array(
                                    "student_id"=>$nValue,
                                    "student_klasse"=>$klasse,
                                    "student_navn"=>$navn,
                                    "student_type"=>$type);


                        } // Vedkommende tilhorer ingen klasse
                        else{
                             
                             $klasse = "null";
                             $navn = $content;
                             $type = "Annet";
                            
                                $studentListe[] = array(
                                    "student_id"=>$nValue,
                                    "student_klasse"=>$klasse,
                                    "student_navn"=>$navn,
                                    "student_type"=>$type);
                    }
                }
            }         
        }
        $html->clear();
        return $studentListe;
}