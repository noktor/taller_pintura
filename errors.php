<?php

function __($text){return $text;}

Errors::$str_error = __('Ha ocurrido un error y no se ha podido procesar tu petición.');
Errors::$str_error_wait = __('Ha ocurrido un error y no se ha podido procesar tu petición. Los administradores han sido notificados, en breve se pondrán en contacto contigo para informarte como terminar el proceso.');

Errors::$str_please_redo = __('Ha ocurrido un error y no se ha podido procesar tu petición.<br>Por favor vuelve a intentarlo. Si el problema persiste por favor <a class="feedback-toggle">notifícanoslo</a>.');
Errors::$str_please_reload = __('Ha ocurrido un error y no se ha podido procesar tu petición.<br>Por favor recarga la página y vuelve a intentarlo. Si el problema persiste por favor <a class="feedback-toggle">notifícanoslo</a>.');

Errors::$str_report = __('Si el problema persiste por favor <a class="feedback-toggle">notifícanoslo</a>.');

class Errors
{
	protected $_private	= array();		//!< Errores que no pueden mostrarse al público.
	protected $_public	= array();		//!< Errores que pueden mostrarse al público.

	static public $str_error;			//!< ha ocurrido un error. punto.
	static public $str_error_wait;		//!< ha ocurrido un error, quito parao, los admin se pondran en contacto contigo.
	static public $str_please_redo;		//!< ha ocurrido un error, reintantalo plis.
	static public $str_please_reload;	//!< ha ocurrido un error, recarga i reintentalo plis.
	static public $str_report;			//!< Coletilla que activa la caja feedback.
	
	public $accumulate = false;			//!< Si true, los errores de un mismo key se acumulan en vez de sobre-escribirse.

	/*!	\brief Añade un error público.
	*/
	public function add_public( $message, $key='general' )
	{
		if( $this->accumulate===false )
		{
			$this->_public[$key] = $message;
		}
		else
		{
			$this->_public[$key][] = $message;
		}
	}


	public function add_hypocritical( $public_message, $private_message, $key='general' )
	{
		$this->add_public( $public_message, $key );
		$this->add_private( $private_message, $key );
	}


	/*!	\brief Añade un error privado.
	*/
	public function add_private( $message, $key='general' )
	{
		//Registramos el error en log
		//Log::add( Log::ERROR, $message );

		if( $this->accumulate===false )
		{
			$this->_private[$key] = $message;
		}
		else
		{
			$this->_private[$key][] = $message;
		}
	}


	public function count()
	{
		return max( count( $this->_public ), count($this->_private) );
	}

	public function free()
	{
		return $this->count()==0;
	}

	public function get_public( $key=null, $default=null )
	{
		if( $key===null )
		{
			return $this->_public;
		}
		else
		{
			return ( isset( $this->_public[$key] ) )? $this->_public[$key]:$default;
		}
	}
	
	public function get_private()
	{
		return $this->_private;
	}

}