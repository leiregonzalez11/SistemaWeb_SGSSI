<?php

class ControlSesion {
	
	public static function iniciar_sesion($email_usuario) {
		if (session_id() == '') {
			session_start();
		}
		
		$_SESSION['email_usuario'] = $email_usuario;
	}
	
	public static function cerrar_sesion() {
		if (session_id() == '') {
			session_start();
		}
		
		if (isset($_SESSION['email_usuario'])) {
			unset($_SESSION['email_usuario']);
		}
		
		
		session_destroy();
	}
	
	public static function sesion_iniciada() {
		if (session_id() == '') {
			session_start();
		}
		
		if(isset($_SESSION['email_usuario'])) {
			return true;
		} else {
			return false;
		}
	}
}