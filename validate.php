<?php


class Validate
{

	static public function is_empty( $value )
	{
		$value = chop( $value );
		$value = trim( $value );

		if( strlen( $value )==0 )
		{
			return true;
		}
		else
			return false;
	}




	/**
	*	Valida el mail.
	*
	*	Se usa patrón regex extraido de http://fightingforalostcause.net/misc/2006/compare-email-regex.php.
	*	Si el mail pasa el regex, se mira si el dominio del mail pertenece a alguno de los listados en $banned_domains (Basado http://code.google.com/p/mailvalidator/ )
	*/
	static public function is_email( $value )
	{
		//Patr? sacado de http://fightingforalostcause.net/misc/2006/compare-email-regex.php
		//$pattern = '/^(?:(?:(?:[^@,"\[\]\x5c\x00-\x20\x7f-\xff\.]|\x5c(?=[@,"\[\]\x5c\x00-\x20\x7f-\xff]))(?:[^@,"\[\]\x5c\x00-\x20\x7f-\xff\.]|(?<=\x5c)[@,"\[\]\x5c\x00-\x20\x7f-\xff]|\x5c(?=[@,"\[\]\x5c\x00-\x20\x7f-\xff])|\.(?=[^\.])){1,62}(?:[^@,"\[\]\x5c\x00-\x20\x7f-\xff\.]|(?<=\x5c)[@,"\[\]\x5c\x00-\x20\x7f-\xff])|[^@,"\[\]\x5c\x00-\x20\x7f-\xff\.]{1,2})|"(?:[^"]|(?<=\x5c)"){1,62}")@(?:(?!.{64})(?:[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.?|[a-zA-Z0-9]\.?)+\.(?:xn--[a-zA-Z0-9]+|[a-zA-Z]{2,6})|\[(?:[0-1]?\d?\d|2[0-4]\d|25[0-5])(?:\.(?:[0-1]?\d?\d|2[0-4]\d|25[0-5])){3}\])$/';
		// El siguiente patr? es el mismo que el comentado, la ?nica diferencia est?en que el grupo pasivo despu? de la @ ya no es pasivo, pues necesitamos
		// conocer el dominio
		$pattern = '/^(?:(?:(?:[^@,"\[\]\x5c\x00-\x20\x7f-\xff\.]|\x5c(?=[@,"\[\]\x5c\x00-\x20\x7f-\xff]))(?:[^@,"\[\]\x5c\x00-\x20\x7f-\xff\.]|(?<=\x5c)[@,"\[\]\x5c\x00-\x20\x7f-\xff]|\x5c(?=[@,"\[\]\x5c\x00-\x20\x7f-\xff])|\.(?=[^\.])){1,62}(?:[^@,"\[\]\x5c\x00-\x20\x7f-\xff\.]|(?<=\x5c)[@,"\[\]\x5c\x00-\x20\x7f-\xff])|[^@,"\[\]\x5c\x00-\x20\x7f-\xff\.]{1,2})|"(?:[^"]|(?<=\x5c)"){1,62}")@((?!.{64})(?:[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.?|[a-zA-Z0-9]\.?)+\.(?:xn--[a-zA-Z0-9]+|[a-zA-Z]{2,6})|\[(?:[0-1]?\d?\d|2[0-4]\d|25[0-5])(?:\.(?:[0-1]?\d?\d|2[0-4]\d|25[0-5])){3}\])$/';

		$m = array();
		if( !preg_match( $pattern, $value, $m ) )
		{
			return false;
		}

		$banned_domains = array(
			'owlpic.com',
			'mailinator.com',
			'itrashmail.com',
			'guerrillamailblock.com',
			'jetable.com',
			'spamgourmet.com',
			'tempemail.net',
			'thismail.ru',
			'yopmail.com',
			'mailforspam.com',
			'odnorazovoe.ru',
			'asdasd.ru',
			'disposableinbox.com',
			'hmamail.com',
			'mytrashmail.com',
			'trashymail.com',
			'trash2009.com',
			'spamavert.com',
			'spamspot.com'
		);

		if( in_array( mb_strtolower( $m[1] ), $banned_domains ) )
		{
			return false;
		}

		return true;
	}


	static public function is_url( $url )
	{
		//Note that the function will only find ASCII URLs to be valid; internationalized domain names (containing non-ASCII characters) will fail.
		return ( filter_var( $url, FILTER_VALIDATE_URL )===false )? false:true;
	}


	static public function is_integer( $value )
	{
		return preg_match( '/^\d+$/', $value )? true:false;
	}



	/*!	\brief Valida que el valor sea un n?mero
	*/
	static public function is_number( $value, $decimal_char='.' )
	{
		$pattern = "/[0-9\\.,]+$/";
		return self::match( $value, $pattern );
	}


	static public function is_word( $value )
	{
		return !self::match( $value, '/^[0-9]+$/' );
	}
	


	static public function is_alphanumeric( $value )
	{
		return self::match( $value, '/^[0-9a-zA-Z\-]+$/' );
	}



	static public function is_min_length( $value, $length )
	{
		if( strlen( $value ) >= $length )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	static public function is_max_length( $value, $length )
	{
		if( strlen( $value ) > $length )
		{
			return false;
		}
		else
		{
			return true;
		}
	}




	static function match( $value, $pattern )
	{
		$result = preg_match( $pattern, $value );

		if( $result===FALSE || $result==0 )
		{
			return false;
		}
		else
		{
			return true;
		}
	}


	static function dont_match( $value, $pattern )
	{
		return !self::match( $value, $pattern );
	}




	static public function is_hex_color( $value )
	{
		$hex_pattern = '/^#[0-9A-Fa-f]{3,6}$/';
		if( !self::is_empty( $value ) &&  self::dont_match( $value, $hex_pattern ) )
		{
			return false;
		}
		
		return true;
	}
}