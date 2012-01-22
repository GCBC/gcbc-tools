<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Itemised_bill_emailer extends CI_Controller
{

	public function index()
	{

        if( ! $this->user_model->has_permission("itemised_bill_emailer") )
        {
            redirect(site_url('error/permission'));
        }
        
        $this->template->write("title","Itemised Bill Emailer - Info");
        $this->template->write_view("content","itemised_bill_emailer/menu_view.php");
        $this->template->write_view("content","itemised_bill_emailer/info_view.php");
        $this->template->render();
	}

	public function view()
	{

        if( ! $this->user_model->has_permission("itemised_bill_emailer") )
        {
            redirect(site_url('error/permission'));
        }
        
        $this->load->model("bill_item_model");
        
        $this->template->write("title","Itemised Bill Emailer - View Store");
        $this->template->write_view("content","itemised_bill_emailer/menu_view.php");
        
        $emails = $this->bill_item_model->get_emails();
        
        foreach( $emails as $email )
        {
            $view_data = $this->bill_item_model->get_bill($email);
            $this->template->parse_view("content","itemised_bill_emailer/view_store_view.php",$view_data);
        }

        $this->template->render();
	}
	
	public function send()
	{
        if( ! $this->user_model->has_permission("itemised_bill_emailer") )
        {
            redirect(site_url('error/permission'));
        }
        
        $this->load->library("form_validation");
            
        $this->form_validation->set_rules('from','From','required|valid_email');
        $this->form_validation->set_rules('bcc','BCC','');
        $this->form_validation->set_rules('confirm','Confirm','required');
        
        if( $this->form_validation->run() )
        {
            // ASSERT: Ready to send emails
            
            // Send emails.
        
            $this->load->model("bill_item_model");
            $this->load->library("email");
            $this->email->initialize(array(
                "mailtype" => "html"
            ));
            $this->template->set_template("email");
            
            $this->email->from($this->input->post("from"));
            $this->email->bcc($this->input->post("bcc"));
            
            $emails = $this->bill_item_model->get_emails();
            
            foreach( $emails as $email )
            {
                $this->email->to($email);
                
                $this->email->subject('GCBC Itemised Bill');
                
                $view_data = $this->bill_item_model->get_bill($email);
                $this->template->parse_view("content","itemised_bill_emailer/bill_email_html_view.php",$view_data,TRUE);
                $this->email->message($this->template->render('',TRUE));
                $this->email->set_alt_message($this->parser->parse("itemised_bill_emailer/bill_email_text_view",$view_data,TRUE));
                
                $this->email->send();
            }
            
            // Clear store.
            
            $this->bill_item_model->clear();
            
            // Success message
            
            $this->template->set_template("default");
            $this->template->write("title","Itemised Bill Emailer - Send Emails");
            $this->template->write_view("content","itemised_bill_emailer/menu_view.php");
            $this->template->write("content","<p>Emails sent!</p>");
            $this->template->render();
        }
        else
        {
            // ASSERT: Not ready to send emails
            
            $this->template->write("title","Itemised Bill Emailer - Send Emails");
            $this->template->write_view("content","itemised_bill_emailer/menu_view.php");
            $this->template->write_view("content","itemised_bill_emailer/send_form_view.php");
            $this->template->render();
        }
	}

	public function upload()
	{
        if( ! $this->user_model->has_permission("itemised_bill_emailer") )
        {
            redirect(site_url('error/permission'));
        }
        
        // Allow any file type as upload library playing silly buggers and use www/upload.
        $config['upload_path'] = '../uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '2048'; // 2 MB
        $config['file_name'] = 'bill_items.csv';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);
        
        if( ! $this->upload->do_upload() )
        {
            // ASSERT: Upload not successful or not attempted.
            
            $this->template->write("title","Itemised Bill Emailer - Upload");
            $this->template->write_view("content","itemised_bill_emailer/menu_view.php");
            $this->template->write_view("content","itemised_bill_emailer/upload_form_view.php",array("errors"=>$this->upload->display_errors('','')));
            $this->template->render();
        }
        else
        {
            // ASSERT: Upload successful.
            
            // array(14) { ["file_name"]=> string(14) "bill_items.csv" ["file_type"]=> string(10) "text/plain" ["file_path"]=> string(38) "/var/www/gcbc-tools/trunk/www/uploads/" ["full_path"]=> string(52) "/var/www/gcbc-tools/trunk/www/uploads/bill_items.csv" ["raw_name"]=> string(10) "bill_items" ["orig_name"]=> string(14) "bill_items.csv" ["client_name"]=> string(15) "test-data-1.csv" ["file_ext"]=> string(4) ".csv" ["file_size"]=> float(0.86) ["is_image"]=> bool(false) ["image_width"]=> string(0) "" ["image_height"]=> string(0) "" ["image_type"]=> string(0) "" ["image_size_str"]=> string(0) "" }
            
            $this->load->model("bill_item_model");
            
            $upload_data = $this->upload->data();
            
            // Read the csv one bill item at a time into the database.
            
            $file_handle = fopen($upload_data['full_path'],'r');
            
            while( $bill_item = fgetcsv($file_handle) )
            {
                $this->bill_item_model->add($bill_item[0],$bill_item[1],$bill_item[3],$bill_item[4],$bill_item[5]);
            }
            
            $this->template->write("title","Itemised Bill Emailer - Upload");
            $this->template->write_view("content","itemised_bill_emailer/menu_view.php");
            $this->template->write("content","<p>File uploaded!</p>");
            $this->template->render();
        }
	}

	public function clear()
	{

        if( ! $this->user_model->has_permission("itemised_bill_emailer") )
        {
            redirect(site_url('error/permission'));
        }
        
        $this->load->model("bill_item_model");
        $this->bill_item_model->clear();
        
        $this->template->write("title","Itemised Bill Emailer - Clear Store");
        $this->template->write_view("content","itemised_bill_emailer/menu_view.php");
        $this->template->write("content","<p>Store cleared.</p>");
        $this->template->render();
	}
	
}

?>
