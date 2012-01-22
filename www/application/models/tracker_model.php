<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracker_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
    }
    
    function delete()
    {
        $this->db->update("Participant",array("Deleted"=>TRUE));
        $this->db->update("Team",array("Deleted"=>TRUE));
        $this->db->update("Leg",array("Deleted"=>TRUE));
    }

}

?>
