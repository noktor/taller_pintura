<?php

/*

	Esta clase permite mensages Flash.
	Los mensajes Flash son mensajes que persisten entre
	diferentes peticiones HTTP.
	
	De esta manera la pagina A puede enviar un mensaje 
	la pagina B sin user $_GET $_POST.


	Los mensajes persisten usando la sesion ($_SESSION)

	
	USO:
	
	1. Mensaje para ser mostrado en la siguiente peticion:
	
		Flash::next( 'error', 'El objeto no pudo ser guardado.' );

	2. Mensaje para ser mostrado en la petición actual:
	
		Flash::now( 'error', 'El objeto no pudo ser guardado.' );

	3. Mantener mensajes antiguos para la siguiente petición:
	
		Flash::keep();

*/
class Flash
{
	//String usado para identificar la informacion dentro de la $_SESSION
	static protected $session_key = 'flash';
	static protected $init = false;
	static protected $messages = array(
		'prev'	=> array(),
		'next'	=> array(),
		'now' 	=> array()
	);

	static protected $cache_get = array();


	static protected function init()
	{
		if( self::$init===false )
		{
			session_start();
			self::$messages['prev'] = isset($_SESSION[self::$session_key])? $_SESSION[self::$session_key]:array();
			unset( $_SESSION[ self::$session_key ] );
			self::$init = true;
		}
	}



	static protected function save()
	{
		$_SESSION[ self::$session_key ] = self::$messages['next'];
	}




	// Static methods
	static public function now( $key, $value )
	{
		self::$messages['now'][(string)$key] = $value;
	}



	/*!	\brief Configura un mensaje flash para la siguiente petición.
	*/
	static public function next( $key, $value )
	{
		self::init();
		self::$messages['next'][(string)$key] = $value;
		self::save();
	}


	/*!	\brief Transfiere mensajes flash de la petición
		anterior para que estén disponibles en la siguiente.
	*/
	static public function keep()
	{
		self::init();
		foreach( self::$messages['prev'] AS $key=>$val )
		{
			self::$messages['next'][$key] = $val;
		}

		self::save();
	}



	/**
	*	Obtiene los mensajes flash visibles para la petición actual.
	*
	*	@param $key. Si solo queremos obtener una clave concreta, podemos indicarla
	*				 con este parámetro.
	*	@param $default. Si se indica `$key`, podemos especificar el valor por defecto a devolver
	*					 en caso de que la clave no exista.
	*
	*	@return Devuelve el array completo situado en `prev`+`now`.
	*			Si se ha indicado `$key`, se devolverá el valor de esa clave y 
	*			si no existe se devolverá `$default`.
	*/
	static public function get( $key=null, $default=null )
	{
		self::init();
		self::$cache_get = array_merge( self::$messages['prev'], self::$messages['now'] );

		if( $key!==null )
		{
			return isset(self::$cache_get[$key])? self::$cache_get[ $key ]:$default;
		}
		else
		{
			return self::$cache_get;
		}
	}
}