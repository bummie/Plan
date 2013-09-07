<?php

/*

Cheat Sheet:

	DB::Connect( 'mysql:host=localhost;dbname=mydatabase', 'user', 'password' );

	A single value:
	DB::QueryValue( "SELECT count(*) FROM users" );

	A single row:
	$count = DB::QueryRow( "SELECT id, name, shoesize FROM users WHERE id = 17" );

	A single row:
	$details = DB::QueryRow( "SELECT id, name, shoesize FROM users WHERE id = :id", array( ':id' => $userid ) );

	A table:
	$users = DB::Query( "SELECT id, name, shoesize FROM users" );

*/


class DB
{
	static $db = null;
	static $queries = 0;
	static $ms = 0;

	//
	// Connect to a PDO database
	//
	static function Connect( $connectstr, $username, $password, $persistant = false, $throwerror = true )
	{
		DEBUG::Msg( "Connecting to database", 'db' );
		
		$time = microtime( true );
		
		$options = array();

		try 
		{
			DB::$db = @new PDO( $connectstr, $username, $password, $options );
		} 
		catch ( exception $e )
		{
			DEBUG::Msg( "Connection Failed!", 'db' );
			
			if ( $throwerror )
				DEBUG::Error( array( 'error' => "Failed to connect", 'message' => $e->getMessage() ), 'DB' );

			return false;
		}

		DB::$ms +=  microtime( true ) - $time;
				
		DEBUG::Msg( "Connected!", 'db' );

		return true;
	}
	
	//
	// Throws an error if the database isn't ready
	//
	static function Check()
	{
		if ( !DB::$db )
			DEBUG::Error( array( 'error' => "No Connection" ), 'DB' );
	}

	//
	// Prepared statement wrapper
	//
	static function Query( $str, $arry = null )
	{
		DB::Check();
		DB::$queries++;
		
		DEBUG::Msg( "Query Start: [".$str."]", 'db' );
		
		$time = microtime( true );
		
		$st = DB::$db->prepare( $str );

		if ( !$st )
			DEBUG::Error( array( 'error' => "Create Query Failed", 'query' => $str, 'array' => $arry, 'message' => DB::$db->errorInfo() ), 'DB' );

		if ( !$st->execute( $arry ) )
			DEBUG::Error( array( 'error' => "Query Failed", 'query' => $str, 'array' => $arry, 'message' => $st->errorInfo()), 'DB' );
		
		$result = $st->fetchAll( PDO::FETCH_ASSOC );	
		
		DEBUG::Msg( "Done", 'db' );
		
		DB::$ms +=  microtime( true ) - $time;
		
		return $result;
	}

	static function QueryRow( $str, $arry = null ) { $ret = DB::Query( $str, $arry ); return reset( $ret ); }
	static function QueryValue( $str, $arry = null ) { $ret = DB::QueryRow( $str, $arry ); return reset( $ret ); }
		
	//
	// Called when shutting down
	//
	static function OnShutdown()
	{
		DEBUG::Msg( "Database: ". DB::$queries . " queries (". round( DB::$ms, 3 ) . " seconds)", 'db'  );
	}

}