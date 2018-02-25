<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

function index()
	{
		$this->session->sess_destroy();
		redirect(base_url().'index.php/login');	
	}
}