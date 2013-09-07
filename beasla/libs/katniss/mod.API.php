<?php

abstract class API
{	
	//
	// Called to trigger the API system, so that the appropriate class will
	// be found and get called.
	//
	static function Handle()
	{
		DEBUG::Msg( "API::Handle", 'api' );
		
		//
		// TODO: We might need to clean this path up
		// to make sure the slashes match perfectly
		//
		$url = parse_url( $_SERVER[ 'REQUEST_URI' ] );
		$path = $url['path'];
		
		//
		// If the path starts with the config basepath - strip it out.
		//
		$basepath = KAT::GetConfig( 'APIBasePath' );
		if ( $basepath )
		{
			if ( strpos( $path, KAT::GetConfig( 'APIBasePath' ) ) == 0 ) 
				$path = substr( $path, strlen(KAT::GetConfig( 'APIBasePath' )) );
		}
		
		//
		// Convert from the path to a classname
		//
		$seek = str_replace( "/", "_", $path );
		$seek = trim( $seek, "_" );
		if ( strpos( $seek, "api_" ) !== 0 ) $seek = "api_".$seek;
		
		DEBUG::Msg( "Path is \"$path\" (looking for class '$seek')", 'api' );
		
		//
		// Does this class exist?
		//
		if ( !class_exists( $seek ) || !is_subclass_of( $seek, 'API' ) )
		{
			DEBUG::Msg( "Unhandled", 'api' );
			return false;
		}
		
		DEBUG::Msg( "Found!", 'api' );

		//
		// Create the class and let it take over proceedings
		//
		$handler = new $seek;
			
		return $handler->RunInternal();

	}
	
	//
	// Output a success array
	//
	static function Success( $array = null )
	{
		DEBUG::Msg( "Success", 'api' );
		
		API::Output( array( 'status' => 'ok', 'data' => $array ) );		
	}

	//
	// The api call has failed for some reason. 
	// Will output the varname too - to help clientside scripts highlight the problem
	//
	static function Failure( $message, $varname = '' )
	{
		DEBUG::Msg( "Failure", 'api' );
		
		API::Output( array( 'status' => 'failure', 'message' => $message, 'varname' => $varname ) );		
	}
	
	//
	// Take an array and convert it into the appropriate output format
	//
	static function Output( $array )
	{
		$fmt = CLIENT::String( 'fmt', KAT::GetConfig( 'APIFormat' ) );
		
		if ( $fmt == 'json' )
		{
			DEBUG::SuppressConsole();
			header( 'Content-Type: text/javascript; charset=utf8' );
			echo json_encode( $array, JSON_NUMERIC_CHECK );
			return true;
		}
		
		if ( $fmt == 'html' )
		{
			echo "<pre>";
			echo htmlspecialchars( print_r( $array, true ) );
			echo "</pre>";
			return true;
		}
		
		return false;
	}

	//
	// Inputs
	//
	static function Int( $name, $help, $min = -2147483647, $max = 2147483647, $default = null )
	{ 
		return array( 'type' => 'integer', 'name' => $name, 'min' => $min, 'max' => $max, 'default' => $default, 'value' => CLIENT::Int( $name, $default, $min, $max ) ); 
	}

	static function IntArray( $name, $help, $mincount = 1, $maxcount = 2147483647, $min = -2147483647, $max = 2147483647, $default = null )
	{ 
		return array( 'type' => 'integer_array', 'name' => $name, 'mincount' => $mincount, 'maxcount' => $maxcount, 'min' => $min, 'max' => $max, 'default' => $default, 'value' => CLIENT::IntArray( $name, $default, $mincount, $maxcount, $min, $max ) ); 
	}

	static function Float( $name, $help, $min = -2147483647, $max = 2147483647, $default = null )
	{ 
		return array( 'type' => 'float', 'name' => $name, 'min' => $min, 'max' => $max, 'default' => $default, 'value' => CLIENT::Float( $name, $default, $min, $max ) ); 
	}
	
	static function String( $name, $help, $minlen = 0, $maxlen = 2147483647, $default = null )
	{ 
		return array( 'type' => 'string', 'name' => $name, 'minlen' => $minlen, 'maxlen' => $maxlen, 'default' => $default, 'value' => CLIENT::String( $name, $default, $minlen, $maxlen ) ); 
	}
	
	//
	// The actual class
	//

	//
	// Override these functions
	//
	function Input( &$input ){}
	function Run( &$args ){}
	
	//
	// Don't override this! And don't call it!
	//
	function RunInternal()
	{
		DEBUG::Msg( "Handler Input", 'api' );

		$input = array();

		//
		// Builds a list of input variables
		//		
		$this->Input( $input );

		$args = array();

		//
		// Validate each input, throw an error if they're not OK.
		// Copy to 'args' if they're good.
		//
		foreach ( $input as $k => $v )
		{
			if ( $v['value'] === null )
			{
				DEBUG::Msg( "Required $v[type] '$v[name]'", 'api' );
				return API::Failure( "Required $v[type] '$v[name]'", $v['name'] );
			}

			$args[ $k ] = $v['value'];
			
		}

		DEBUG::Msg( "Handler Run", 'api' );

		//
		// Actually run the API
		//
		$this->Run( $args );

		DEBUG::Msg( "Handler Finished", 'api' );
		return true;
	}
}