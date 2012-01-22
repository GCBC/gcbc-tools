<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function index()
	{
	    log_message('1',$this->user_model->is_logged_in());
        if( ! $this->user_model->is_logged_in() )
        {
            redirect(site_url('user/login'));
        }
        
        $this->template->write('title','Select a tool...');
        $this->template->render();
	}
	
}

?>
