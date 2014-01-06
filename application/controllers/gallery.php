<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data = array('images' => $this->get_candles());
		
		$this->load->view('gallery',$data);
	}
	
	private function get_candles(){
		$this->load->helper('directory');
		
		$images = directory_map('./images/candles/',1);
		
		
		
		return $images;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */