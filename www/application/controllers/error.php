<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller
{

	public function permission()
	{
        $this->template->set_template("content-only");
        $this->template->write("title","Error");
        $this->template->write_view("content","error/permission_view");
        $this->template->render();
	}
	
}

?>
