<?php 

class KAT
{
	static $cfgdata =  array
	(
		'Reporter'		=>	null,		// function( $msg, $module ) - called via DEBUG to report errors home (usually via email)
		'ErrorHandler'	=>	null,		// function( $msg, $module ) - called via DEBUG on Error (to let you show nice error message)
		'APIBasePath'	=>	null,		// string - remove this from the path to determine the real api path ie '/myapi/'
		'APIFormat'		=>	'json',		// string - the default format for the API to output ['json', 'xml', 'html']
	);

	//static $StarTLoadTime = microtime( true );
	static function Config( $k, $v ) { KAT::$cfgdata[ $k ] = $v; }
	static function GetConfig( $k ) { return KAT::$cfgdata[ $k ]; }
	
	
	//
	// Include a module
	//
	static function Module( $name )
	{
		require_once( 'mod.'.$name.'.php' ); 
	}
	
	//
	// Basic Init function
	//
	static function Init( $defaultmodules = true )
	{
		KAT::Module( 'API' );
		KAT::Module( 'DB' );
		KAT::Module( 'CLIENT' );
		KAT::Module( 'DEBUG' );
		KAT::Module( 'STRING' );

		register_shutdown_function( 'KAT::OnShutdown' );
	}
	
	//
	// Require - just like require_once but logged
	//
	static function IncludePHP( $name )
	{
		DEBUG::Msg( "Loading \"$name\"", 'include' );
		require_once( $name );
	}
	
	//
	// Called when shutting down
	//
	static function OnShutdown()
	{
		DB::OnShutdown();
		
		// Should always be last!
		DEBUG::OnShutdown();
	}
}

?>