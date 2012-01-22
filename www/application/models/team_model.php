<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
    }
    
    function add($name)
    {
        $this->db->insert('Team',array("Name"=>$name));
    }
    
    function delete($id)
    {
        $this->db->where('TeamID',$id)->update("Team",array("Deleted"=>TRUE));
        $this->db->where('TeamID',$id)->update("Participant",array("Deleted"=>TRUE));
    }
    
    /*
     * @return array of team arrays
     *
     * team array = ["TeamID"=>"...", "Name"=>"..."];
    */
    function get_all()
    {
        $query = $this->db->order_by("Name")->get_where("Team",array("Deleted"=>FALSE));
        return $query->result_array();
    }

}

?>
