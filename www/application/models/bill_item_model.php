<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bill_item_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
    }
    
    /*
     * @param $name - Name of person being billed
     * @param $email - Email address of person being billed
     * @param $description - Description of item being billed for
     * @param $date - Date of item being billed for
    */
    function add($name,$email,$description,$cost,$date)
    {
        $date_split = explode("/",$date);
        $bill_item = array(
            'Name' => $name,
            'Email' => $email,
            'Description' => $description,
            'Cost' => $cost,
            'Date' => "$date_split[2]-$date_split[1]-$date_split[0]"
        );
        $query = $this->db->insert('BillItem',$bill_item);
    }
    
    /*
     * @return array of unique email addresses
    */
    function get_emails()
    {
        $this->db->select("Email");
        $this->db->distinct();
        $query = $this->db->get("BillItem");
        $result = array();
        foreach( $query->result() as $row )
        {
            $result[] = $row->Email;
        }
        return $result;
    }
    
    /*
     * @param $email
     *
     * @return array of objects $bill_items
     *
     * $bill_item->Name, $bill_item->Email, ...
    */
    function get_items($email)
    {
        $this->db->order_by("Date asc");
        $query = $this->db->get_where("BillItem",array("Email"=>$email));
        $result = array();
        foreach( $query->result_array() as $bill_item )
        {
            $bill_item["Cost"] = floatval($bill_item["Cost"]);
            $bill_item["Date"] = date("d/m/Y",strtotime($bill_item["Date"]));
            $result[] = $bill_item;
        }
        return $result;
    }
    
    /*
     * @param $email
     *
     * @return float - Total cost of bill items for that email address.
    */
    function get_total_cost($email)
    {
        $this->db->select_sum("Cost");
        $query = $this->db->get_where("BillItem",array("Email"=>$email));
        $result = $query->row();
        return $result->Cost;
    }
    
    /*
     * @param $email
     *
     * @return Bill object if items for email, NULL otherwise
    */
    function get_bill($email)
    {
        $items = $this->get_items($email);
        if( count($items) == 0 )
        {
            return NULL;
        }
        else
        {
            return array(
                "name" => $items[0]["Name"],
                "email" => $email,
                "total_cost" => $this->get_total_cost($email),
                "items" => $items
            );
        }
    }
    
    function clear()
    {
        $this->db->empty_table("BillItem");
    }

}

?>
