<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Participant_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
    }
    
    function add($team_id,$name)
    {
        $this->db->insert('Participant',array("TeamID"=>$team_id, "Name"=>$name));
    }
    
    function delete($id)
    {
        $this->db->where('ParticipantID',$id)->update("Participant",array("Deleted"=>TRUE));
    }
    
    /*
     * @return array of participant arrays
    */
    function get_all()
    {
//        $query = $this->db->order_by("Name")->get_where("Participant",array("Deleted"=>FALSE));
//        return $query->result_array();
//        $query = $this->db->from("Participant")->join("Team","Participant.TeamID = Team.TeamID")->get();
        $sql = 'SELECT p.ParticipantID, p.Name ParticipantName, t.Name TeamName
        FROM Participant p
        JOIN Team t
        ON p.TeamID = t.TeamID
        WHERE p.Deleted = FALSE
        ORDER BY t.Name, p.Name';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}

?>
