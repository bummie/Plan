<?php

class CLIENT
{
	static function IP()
	{
		return $_SERVER['REMOTE_ADDR'];
	}
	
	//
	// Get a client string
	//
	static function String( $name, $default = null, $minlen = null, $maxlen = null )
	{
		$str = null;
		
		if ( isset( $_GET[$name] ) && $_GET[$name] != '' ) $str = (string)$_GET[$name];
		if ( isset( $_POST[$name] ) && $_POST[$name] != '' ) $str = (string)$_POST[$name];

		if ( $str == null ) return $default;
		if ( $minlen != null && strlen( $str ) < $minlen ) return $default;
		if ( $maxlen != null && strlen( $str ) > $maxlen ) return $default;
		
		return $str;
	}

	//
	// Get a client integer
	//
	static function Int( $name, $default = null, $min = null, $max = null )
	{
		$val = CLIENT::String( $name, $default );

		if ( filter_var( $val, FILTER_VALIDATE_INT ) === false )
			return $default;
		
		if ( $min != null && $val < $min ) return $default;
		if ( $max != null && $val > $max ) return $default;

		return $val;
	}
	
	//
	// Get a client float
	//
	static function Float( $name, $default = null, $min = null, $max = null )
	{
		$val = CLIENT::String( $name, $default );

		if ( filter_var( $val, FILTER_VALIDATE_FLOAT ) === false )
			return $default;
		
		if ( $min != null && $val < $min ) return $default;
		if ( $max != null && $val > $max ) return $default;

		return (float)$val;
	}
	
	//
	// Get a JSON formatted Integer Array
	//
	static function IntArray( $name, $default, $mincnt = null, $maxcnt = null, $min = null, $max = null )
	{
		$val = CLIENT::String( $name, $default );
		if ( $val == null ) return $default;

		$val = json_decode( $val, true, 2 );
		if ( $val == null ) return $default;

		foreach ( $val as $v )
		{
			if ( filter_var( $v, FILTER_VALIDATE_INT ) === false )
				return $default;
			
			// Out of range
			if ( $min != null && $v < $min ) return $default;
			if ( $max != null && $v > $max ) return $default;
		}
		
		if ( $mincnt != null && count( $val ) < $mincnt ) return $default;
		if ( $maxcnt != null && count( $val ) > $maxcnt ) return $default;

		return $val;
	}

	//
	// Get a client email
	//
	static function Email( $name, $default = null )
	{
		$val = CLIENT::String( $name, $default );

		if ( filter_var( $val, FILTER_VALIDATE_EMAIL ) === false )
			return $default;

		return $val;
	}

}