<?php

/*

	String utilities

*/


class STRING
{
	//
	// Returns the text between two strings
	// (you could do this with a regex if you were smarter than me)
	//
	static function FindBetween( $text, $s1, $s2 )
	{
		$pos_s = strpos( $text, $s1 ) + strlen($s1);
		if ( !$pos_s || $pos_s <= strlen($s1) ) return "";
		
		$pos_e = strpos( $text, $s2, $pos_s );

		return trim( substr( $text, $pos_s, $pos_e-$pos_s ) );
	}
}