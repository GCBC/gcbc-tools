<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leg_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->helper('date');
    }
    
    function start($participant_id)
    {
        $this->db->insert('Leg',array("ParticipantID"=>$participant_id, "Start"=>now()));
    }
    
    function finish($id,$distance)
    {
        $now = now();
//        $this->db->where('LegID',$id)->update("Leg",array("Distance"=>$distance, "Finish"=>now()));
        $sql = 'UPDATE Leg
        SET Distance=?, Finish=?, Duration=?-Start
        WHERE LegID=?';
        $this->db->query($sql,array($distance,$now,$now,$id));
    }
    
    function get_running()
    {
        $sql = 'SELECT l.LegID, FROM_UNIXTIME(l.Start,"%H:%i:%s") Start, TIME_FORMAT(MAKETIME((UNIX_TIMESTAMP()-l.Start)/(60*60),(UNIX_TIMESTAMP()-l.Start)/60,(UNIX_TIMESTAMP()-l.Start)%60),"%H:%i:%s") Duration, p.Name ParticipantName, t.Name TeamName
        FROM Leg l
        JOIN Participant p
        ON l.ParticipantID = p.ParticipantID
        JOIN Team t
        ON p.TeamID = t.TeamID
        WHERE l.Deleted = FALSE
        AND l.Finish IS NULL
        ORDER BY l.Start DESC, t.Name, p.Name';
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function get_completed()
    {
        $sql = 'SELECT l.LegID, FROM_UNIXTIME(l.Start,"%H:%i:%s") Start, FROM_UNIXTIME(l.Finish,"%H:%i:%s") Finish, TIME_FORMAT(MAKETIME(l.Duration/(60*60),l.Duration/60,l.Duration%60),"%H:%i:%s") Duration, p.Name ParticipantName, t.Name TeamName, l.Distance
        FROM Leg l
        JOIN Participant p
        ON l.ParticipantID = p.ParticipantID
        JOIN Team t
        ON p.TeamID = t.TeamID
        WHERE l.Deleted = FALSE
        AND l.Finish IS NOT NULL
        ORDER BY l.Start DESC, t.Name, p.Name';
        $query = $this->db->query($sql);
        return $query->result_array();
    
    }
    
    function get_total()
    {
        $sql = 'SELECT SUM(Distance) Distance
        FROM Leg
        WHERE Deleted = FALSE
        AND Finish IS NOT NULL';
        $query = $this->db->query($sql);
        $row = $query->row();
        $total = $row->Distance;
        return ($total == NULL) ? 0 : $total;   
    }
    
    function get_team_totals()
    {
        $sql = 'SELECT SUM(l.Distance) Distance, SUM(l.Duration) Duration, t.Name
        FROM Leg l
        JOIN Participant p
        ON l.ParticipantID = p.ParticipantID
        JOIN Team t
        ON p.TeamID = t.TeamID
        WHERE l.Deleted = FALSE
        AND p.Deleted = FALSE
        AND t.Deleted = FALSE
        AND l.Finish IS NOT NULL
        GROUP BY t.Name
        ORDER BY Distance desc, t.Name';
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function get_participant_totals()
    {
        $sql = 'SELECT SUM(l.Distance) Distance, SUM(l.Duration) Duration, p.Name
        FROM Leg l
        JOIN Participant p
        ON l.ParticipantID = p.ParticipantID
        WHERE l.Deleted = FALSE
        AND p.Deleted = FALSE
        AND l.Finish IS NOT NULL
        GROUP BY p.Name
        ORDER BY Distance desc, p.Name';
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function delete($id)
    {
        $this->db->where('LegID',$id)->update("Leg",array("Deleted"=>TRUE));
    }
    
    function export()
    {
        $this->load->dbutil();
        
        $sql = "select p.Name ParticipantName,t.Name TeamName,l.Start,l.Finish,l.Duration,l.Distance from Leg l
        join Participant p on l.ParticipantID = p.ParticipantID
        join Team t on p.TeamID = t.TeamID
        where l.Deleted = FALSE
        and p.Deleted = FALSE
        and t.Deleted = FALSE";
    
        $query = $this->db->query($sql);
    
        return $this->dbutil->csv_from_result($query,",");
    }

}

?>
