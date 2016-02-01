<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Controller {

	/**
		Env�o de mensaje de prueba usando la librer�a Mail de CodeIgniter
		y la cuenta creada si lo dese�is para poder utilizarla en vuestras
		pruebas y aplicacion
		
		Datos de configuraci�n de cuenta creada en dominio iessansebastian.com
		para que hag�is pruebas. No envi�is correo a dicha cuenta pues solo tiene
		espacio para 1Mb
		
		Servidor 
		SMTP: mail.iessansebastian.com
		POP3: mail.iessansebastian.com
		
		email: aula4@iessansebastian.com
		Usuario: aula4
				 aula4@iessansebastian.com
		Clave: daw2alumno		
		
	 */
	public function index()
	{
		$this->load->library('email');

		// Probamos con diferentes configuraciones de correo
		
		// Por defecto
//		echo "<h1>\n--- POR DEFECTO ---\n</h1>";
//		$this->EnviaCorreo();
//		
//		// Utilizando sendmail
//		$config['protocol'] = 'sendmail';
//		$config['mailpath'] = '/usr/sbin/sendmail';
//		$config['charset'] = 'utf-8';
//		$config['wordwrap'] = TRUE;
//		
//		$this->email->initialize($config);
//		
//		echo "<h1>\n--- CON SENDMAIL ---\n</h1>";
//		$this->EnviaCorreo();
		
		// Utilizando sendmail
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.iessansebastian.com';
		$config['smtp_user'] = 'aula4@iessansebastian.com';
		$config['smtp_pass'] = 'daw2alumno';
		
		$this->email->initialize($config);
		
		echo "<h1>\n--- CON SMTP y cuenta en servidor externo ---\n</h1>";
		$this->EnviaCorreo();		

	}
	
	private function EnviaCorreo()
	{
		$this->email->from('aula4@iessansebastian.com', 'Camisetas de Fútbol');
		$this->email->to('isacm94@gmail.com'); 
		//$this->email->cc('another@another-example.com'); 
		//$this->email->bcc('them@their-example.com'); 
		
		$this->email->subject('Restablece la contraseña en Camisetas de Fútbol');
		$this->email->message('HOLA MUNDO!!!!!');	
		
		if ( $this->email->send() )
		{
			echo "<pre>\n\nENVIADO CON EXITO\n</pre>";
		}
		else 
		{
			echo "</pre>\n\n**** NO SE HA ENVIADO ****</pre>\n";
		}
		
		echo $this->email->print_debugger();		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */