<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{

	public function login()
	{
        $this->template->set_template('content-only');
	
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required|callback__attempt_login');
            
        if( $this->form_validation->run() )
        {
            redirect(site_url(''));
        }
        else
        {
            $this->template->write('title','Login');
            $this->template->write_view('content', 'login/form_view');    
            $this->template->render();
        }
	}
    
    function logout()
    {
        $this->user_model->logout();
        redirect(site_url(''));
    }
	
    function _attempt_login() {
        
        if( $this->user_model->login($this->input->post('username'),$this->input->post('password')) )
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('_attempt_login','Username or password incorrect.');
            return FALSE;
        }
        
    }
	
}

?>
