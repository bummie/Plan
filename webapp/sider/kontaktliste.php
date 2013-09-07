<?php

include_once('simple_html_dom.php');

function returnKontaktliste(){
	
	if($_COOKIE['c_table'] != null || $_COOKIE['c_table'] != "")
	{


			$skole = str_replace("beasla_skole_", "", $_COOKIE['c_table']);
            $adresse = 'http://www.' . $skole . '.vgs.no/kontakt-oss/ansatte/?category=&orderby=displayname&view=list';
            
            $data = file_get_html($adresse);
            $identities = $data->find('div[class=identities]', 0);

        echo ($identities->innertext);
    }else{
    	echo ("<center><a href='/webapp/?page=settings_prf'><h3><span style='font-family:verdana,geneva,sans-serif;''>Du har ikke satt opp en profil</span></h3></a></center>");
   }
}
?>

<div class="container">

		<div class="sixteen columns">
			<style type="text/css">

				/*************************************************************************************
				*
				* EMPLOYE // vgs.no
				*
				*************************************************************************************/
				.employe.filter {
					padding	:	13px;
				}
				
				.employe.filter .filterPane {
					float			: left;
				}
				
				.employe.filter .searchPane {
					float			: right;
				}
				
				
				.employe.paging {
					float			:	left;
					width			:	924px;
					padding			:	0px 13px;
					border-bottom	:	1px solid #ccc;
					line-height		:	29px;
				}
				
				.identities {
					padding	:	13px;
				}
				.col .identities {
					padding:0;
				}
				
				.identities ul {
					padding		:	0px;
					margin		:	0px;
					list-style	:	none;
				}
				
				.identities ul li.identity {
					border			:	0px;
					margin			:	0px 0px;
					width			:	430px;
					padding			:	0px 15px;
					min-height		:	250px;
					vertical-align	:	top;
					display			:	-moz-inline-stack;
					display			:	inline-block;
					zoom			:	1;
					*display		:	inline;
					_height			:	250px;
				}
				
				.identities ul li.identity.odd {
					border-right	:	1px solid #ccc;
				}
				
				.identities ul li.identity img.portrait {
					float	:	right;
					margin	:	0px 0px 10px 10px;
				}
				
				.identities ul li.identity p {
					margin	:	10px 0px;
				}
				
				.identities ul li.identity a.moreToggle {
					background	:	transparent url(../images/icon.gif) no-repeat scroll -355px -170px;
					padding		:	0px 0px 0px 6px;
				}
				
				.identity-displayname {
					font-size	:	1.5em;
				}
				
				.identity-title {
					font-size	:	1.2em;
				}
				
				table.identities-table {
					margin			:	0px;
					padding			:	0px;
					border-collapse	:	collapse;
				}
				
				table.identities-table th {
					font-weight	:	bold;
					font-size	:	1.2em;
					border-bottom	:	1px solid #ccc;
					padding			:	4px 2px;
					text-align: left;
				}
				
				table.identities-table td {
					font-size		:	1em;
					padding			:	3px 2px;
				}
				
				table.identities-table tr.even td{
					background-color	:	#f0f0f0;
				}
				
				.identities .box {
					width:304px;
					min-height: 15.6em;
					height:15.6em;
					overflow:hidden;
					float:left;
					margin-right:5px;
				}
				.col3 .identities .box {
					width			:	100%;
					min-height		:	0px !important;
					height			:	auto !important;
				}
				
				.col3 .identities .box .content{
					padding-bottom	:	6px;
				}
				
				.identities ul {
					padding		:	0px;
					margin		:	0px;
					list-style	:	none;
				}
				
				.identities ul li{
				        width: 303px;
				        min-height: 16.5em;
				        display: -moz-inline-stack;
				        display: inline-block;
				        vertical-align: top;
				        margin-right: 2px;
				        zoom: 1;
				        *display: inline;
				        _height: 16em;
						background-color	:	white;
				}
				
				.identities .box .content {
					padding:3px;
					padding-left:10px;
				}
				
				.identities .box H2 {
					font-size:1.2em;
					font-weight:normal;
					padding:0;
					margin:0;
					font-weight:bold;
					color:black;
				}
				
				.identity-title {
					font-size:1em;
				}
				
				.identities IMG {
					float:right;
					margin-right:5px;
				}
				
				.identities img.portrait {
					float	:	right;
					margin	:	0px;
					padding	:	3px;
					border	:	1px solid #ccc;
					border-right	:	0px;
					margin			:	2px 11px 0px 0px;
				}
				
				.relatedIdentities img.portrait{
					border			:	1px solid #ccc;
					border-right	:	0px solid #ccc;
					float			:	right;
					margin			:	-25px -10px 15px 0px;
					padding			:	3px;
				}
				
				.relatedIdentities h2 {
					padding	:	0px;
				}
				
				.relatedIdentities p {
					margin-bottom: 5px;
				}

			</style>
			<?php returnKontaktliste(); ?>
		</div>
</div>
