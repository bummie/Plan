<?php

/*

*/


class DEBUG
{
	static $console = array();
	static $start = 0;
	static $level = 0;
	
	static function Enable( $showconsole = true )
	{
		DEBUG::$level = 1;
		
		if ( $showconsole ) 
			DEBUG::$level = 2;
	}
	
	static function SuppressConsole() { if ( DEBUG::$level == 2 ) DEBUG::$level = 1; }
	
	static function Msg( $str, $mod = 'normal' )
	{	
		if ( DEBUG::$level == 0 ) return;	
		if ( is_array( $str ) ) $str = nl2br( print_r( $str, true ) );
		
		DEBUG::$console[] = array( 'time' => microtime( true ) - DEBUG::$start, 'mod' => $mod, 'msg' => $str );
	}
	
	//
	// Report something (usually via email)
	//
	static function Report( $message, $mod = 'general' )
	{
		$func = KAT::GetConfig( 'Reporter' );
		if ( $func ) $func( $message, $mod );
	}
	
	//
	// A critical error - report and shut down
	//
	static function Error( $desc, $mod = 'general' )
	{
		DEBUG::Report( $desc, $mod );
		
		// If the user has provided a handler then use it
		$func = KAT::GetConfig( 'ErrorHandler' );
		if ( $func ) $func( $desc, $mod );

		DEBUG::Msg( print_r( $desc, true ), 'error' );

		header( '500 Internal Server Error', true, 500 );
		die();
	}
	
	//
	// Called when shutting down
	//
	static function OnShutdown()
	{
		$time = round(microtime( true ) - DEBUG::$start, 3);
		DEBUG::Msg( "Done in $time seconds" );
		
		//
		// Print the console
		//
		if ( DEBUG::$level != 2 )
			return;

		echo DEBUG::GetConsoleHTML();
	}

	static function GetConsoleHTML()
	{
		$out = "";
		
		foreach ( DEBUG::$console as $line )
		{
			$time = sprintf( "%.3f", $line['time'] );
			$out .= "<div><span>[$time]</span> <span class='$line[mod]'>" . htmlspecialchars( $line['msg'] ) . "</span></div>";
		}
		
		return "\n\n\n\n
			<!--DEBUG-->
<style>
#katniss
{
	background-color: #444;
	color: #aaa;
	position: fixed;
	bottom: 0px;
	left: 0px;
	right: 0px;
	height: 300px;
	overflow: auto;
}
#katniss .console
{
	padding: 16px;
	font-family: monospace;
	font-size: 11px;
}
BODY
{
	margin-bottom: 310px;
}

#katniss .console .normal { color: #eee; }
#katniss .console .include { color: #aff; }
#katniss .console .db { color: #fa5; }
#katniss .console .api { color: #5f5; }
#katniss .console .error { background-color: #f00; color: #000; }
</style>
					
<div id='katniss'>
<div class='console'>
	$out
</div>
</div>
";
	}
}

DEBUG::$start = microtime( true );