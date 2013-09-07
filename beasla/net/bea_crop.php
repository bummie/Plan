<?php
	header('Content-Type: image/png');
	setcookie("Seb", "SebS");

	// Verdier

	// Profilverdier beasla.bevster.net/beasla/net/bea_crop.php?skoleid=1&stuid=1&uke=1&planbredde=1&planlengde=1&x=1&y=1&w=1&h=1
	$V_SCHOOLID = isset($_GET['skoleid'])?$_GET['skoleid']:null;
	$V_STUDENTID= isset($_GET['stuid'])?$_GET['stuid']:null;
	$V_WEEK = isset($_GET['uke'])?$_GET['uke']:null;
	$V_WIDTH = isset($_GET['planbredde'])?$_GET['planbredde']:null;
	$V_HEIGHT = isset($_GET['planlengde'])?$_GET['planlengde']:null;
	
	$V_CUT_X = isset($_GET['x'])?$_GET['x']:null;
	$V_CUT_Y = isset($_GET['y'])?$_GET['y']:null;
	$V_CUT_W = isset($_GET['w'])?$_GET['w']:null;
	$V_CUT_H = isset($_GET['h'])?$_GET['h']:null;

	if($V_SCHOOLID != null || $V_STUDENTID != null || $V_WEEK != null || $V_CUT_X != null || $V_CUT_Y != null)
	{
		
		$img = getImageFromUrl(createImgLink($V_SCHOOLID, $V_STUDENTID, $V_WEEK, $V_WIDTH, $V_HEIGHT),  $V_CUT_W, $V_CUT_H, $V_CUT_X, $V_CUT_Y);
	if($img != null)
	{
		header('Content-Type: image/png');
		setcookie("Seb", "SebS");
		imagepng($img, NULL, 0);
		imagedestroy($img);
	}else{
		echo("Oops..");
	}
		
	}else{
		echo("Blablabla - Errorkontrollshit veldig trott snrkkzzzzzzz...");
	}
		

	function createImgLink($skoleid, $stuid, $uke, $bredde, $lengde)
	{
		$BASE_URL = "http://www.novasoftware.se/ImgGen/schedulegenerator.aspx";
		$var_link = "?format=png&schoolid=".$skoleid."&id={".$stuid."}&period=&week=".$uke."&width=".$bredde."&height=".$lengde;
		return $BASE_URL.$var_link;
	}


	function getImageFromUrl($url, $w, $h, $x, $y)
	{
			$link = $url;

            $curl_handle=curl_init(urldecode($link));
            curl_setopt($curl_handle, CURLOPT_NOBODY, true);
            $result = curl_exec($curl_handle);
            $retcode = false;
            if($result !== false)
            {
                $status = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
                if($status == 200)
                    $retcode = true;
            }
            curl_close($curl_handle);

            if($retcode)
            {
                $curl_handle=curl_init();
                curl_setopt($curl_handle,CURLOPT_URL,urldecode($link));
                curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
                curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
                $image = curl_exec($curl_handle);
                curl_close($curl_handle);

                if($image !== false)
                {
                    $img = imagecreatefromstring($image);
                    $crop = imagecreate($w,$h);

                    imagecopy ( $crop, $img, 0, 0, $x, $y, $w, $h );

                    	return $crop;
                }
            } else {
                echo 'File not found !';
                return null;
            }
	}


// http://www.novasoftware.se/ImgGen/schedulegenerator.aspx
// ?format=png&schoolid=72150&id={D62A30AD-3659-419A-8FCD-1CD8D690D7C2}&period=&week=46&width=1329&height=538


	//Testadresse
	//http://beasla.bevster.net/beasla/net/bea_crop.php?skoleid=72150&stuid=E8DC5635-47D1-40EC-91D8-4D6DC8388918&uke=15&planbredde=1329&planlengde=538&x=1&y=1&w=50&h=50