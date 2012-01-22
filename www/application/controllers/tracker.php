<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracker extends CI_Controller
{

	public function index()
	{

        if( ! $this->user_model->has_permission("tracker") )
        {
            redirect(site_url('error/permission'));
        }
        
        $this->template->write("title","Tracker - Info");
        $this->template->write_view("content","tracker/menu_view.php");
        $this->template->write_view("content","tracker/info_view.php");
        $this->template->render();
	}
	
	public function summary()
	{
        if( ! $this->user_model->has_permission("tracker") )
        {
            redirect(site_url('error/permission'));
        }
        
        $this->load->model('leg_model');
        
        $total_distance = $this->leg_model->get_total();
        
        $this->template->write("title","Tracker - Summary");
        $this->template->write_view("content","tracker/menu_view.php");
        $this->template->parse_view("content","tracker/summary_view.php",array("total_distance"=>$total_distance));
        $this->template->render();
	}
	
	public function teams()
	{

        if( ! $this->user_model->has_permission("tracker") )
        {
            redirect(site_url('error/permission'));
        }
        
        $this->load->model("team_model");
        
        $this->template->write("title","Tracker - Teams");
        $this->template->write_view("content","tracker/menu_view.php");
        
        $name = $this->input->post('name');
        
        if( $name != FALSE && $name != '' )
        {
            $this->team_model->add($name);
        }
        
        $post = $this->input->post();
        
        // Check whether there is any teams to delete and then look for keys
        // starting with delete_ then get id from the key.
        $post = $this->input->post();
        if( $post != null )
        {   
            foreach( $post as $k => $v )
            {
                if( substr($k,0,7) == "delete_" )
                {
                    $this->team_model->delete($v);
                }
            }
        }
        
        $teams = $this->team_model->get_all();
        
        $this->template->parse_view("content","tracker/teams_view.php",array("teams"=>$teams));
        $this->template->render();
	}
	
	public function participants()
	{

        if( ! $this->user_model->has_permission("tracker") )
        {
            redirect(site_url('error/permission'));
        }

        $this->load->model("team_model");        
        $this->load->model("participant_model");
        
        $this->template->write("title","Tracker - Participants");
        $this->template->write_view("content","tracker/menu_view.php");
        
        $name = $this->input->post('name');
        $team = $this->input->post('team');
        
        if( $name != FALSE && $name != '' )
        {
            $this->participant_model->add($team,$name);
        }
        
        $post = $this->input->post();
        
        // Check whether there is any participants to delete and then look for keys
        // starting with delete_ then get id from the key.
        $post = $this->input->post();
        if( $post != null )
        {   
            foreach( $post as $k => $v )
            {
                if( substr($k,0,7) == "delete_" )
                {
                    $this->participant_model->delete($v);
                }
            }
        }

        $teams = $this->team_model->get_all();        
        $participants = $this->participant_model->get_all();
        
        $this->template->parse_view("content","tracker/participants_view.php",array("teams"=>$teams,"participants"=>$participants));
        $this->template->render();
	}
	
	public function legs()
	{

        if( ! $this->user_model->has_permission("tracker") )
        {
            redirect(site_url('error/permission'));
        }

        $this->load->model("team_model");        
        $this->load->model("participant_model");
        $this->load->model("leg_model");
        
        $this->template->write("title","Tracker - Legs");
        $this->template->write_view("content","tracker/menu_view.php");
        
        $participant = $this->input->post('participant');
        
        // Check that the user wants to create a participant.
        
        if( $participant != FALSE && $participant != "0" )
        {
            $this->leg_model->start($participant);
        }
        
        // Check whether there are any to finish/delete.
        // Then look for keys starting with delete or finish and use the values
        // to get ids.
        
        $post = $this->input->post();
        
        if( $post != null )
        {   
            foreach( $post as $k => $v )
            {
                if( substr($k,0,7) == "finish_" )
                {
                    $distance = $this->input->post("distance_$v");
                    if( $distance != null && $distance != "" )
                    {
                        $this->leg_model->finish($v,$distance);
                    }
                }
                elseif( substr($k,0,7) == "delete_" )
                {
                    $this->leg_model->delete($v);
                }
            }
        }
        
        $participants = $this->participant_model->get_all();
        $running_legs = $this->leg_model->get_running();
        $completed_legs = $this->leg_model->get_completed();
        
        $this->template->parse_view("content","tracker/legs_view.php",array("participants"=>$participants,"running_legs"=>$running_legs,"completed_legs"=>$completed_legs));
        $this->template->render();
	}

	public function delete()
	{

        if( ! $this->user_model->has_permission("tracker_delete") )
        {
            redirect(site_url('error/permission'));
        }
        
        $this->load->library("form_validation");
        $this->form_validation->set_rules('confirm','Confirm','required');
        
        $this->template->write("title","Tracker - Delete All");
        $this->template->write_view("content","tracker/menu_view.php");
        
        if( $this->form_validation->run() )
        {    
            $this->load->model("tracker_model");
            $this->tracker_model->delete();
            
            $this->template->write("content","<p>All deleted!</p>");
        }else{
            $this->template->write_view("content","tracker/delete_form_view.php");
        }
        $this->template->render();
	}
	
	public function total()
	{
	    $this->load->model("leg_model");
	    
	    echo $this->leg_model->get_total();
	}
	
	public function team_totals()
	{
	    $this->load->model("leg_model");
	    
	    $totals = $this->leg_model->get_team_totals();
        
        $this->template->write("title","Team Totals");
        $this->template->write_view("content","tracker/menu_view.php");
        $this->template->parse_view("content","tracker/totals_view.php",array("totals"=>$totals));
        
        $this->template->render();
	}
	
	public function participant_totals()
	{
	    $this->load->model("leg_model");
	    
	    $totals = $this->leg_model->get_participant_totals();
        
        $this->template->write("title","Participant Totals");
        $this->template->write_view("content","tracker/menu_view.php");
        $this->template->parse_view("content","tracker/totals_view.php",array("totals"=>$totals));
        
        $this->template->render();
	}
	
	public function embed()
	{
	    $this->load->model("leg_model");
	    $total = $this->leg_model->get_total();
	    $target = 2012000;
	    
	    $this->template->set_template("minimal");
	    
	    $this->template->write_view("content","tracker/embed_view",array("total"=>$total,"target"=>$target));
	    
	    $this->template->render();
	}
	
	public function export()
	{

        if( ! $this->user_model->has_permission("tracker") )
        {
            redirect(site_url('error/permission'));
        }
        
        $this->load->model('leg_model');
            
        $this->output->set_header('content-type: text/csv');
        $this->output->set_header('content-disposition: attachment;filename="legs.csv"');
        $this->output->set_output($this->leg_model->export());
	}
}

?>
