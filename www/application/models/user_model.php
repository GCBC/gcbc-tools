<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    
    /*
     * @param string $username
     * @param string $password
     *
     * @return boolean - TRUE if the user could be logged in, FALSE otherwise.
    */
    function login($username,$password)
    {
        $passwords = $this->config->item('passwords','users');
    
        if( isset($passwords[$username]) && $password == $passwords[$username] )
        {
            $this->session->set_userdata("logged_in","TRUE");
            $this->session->set_userdata("user_name",$username);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function logout()
    {
        $this->session->unset_userdata("logged_in",FALSE);
    }
    
    /*
     * @param string $permission
     *
     * @return boolean - TRUE if the user has the permission, FALSE otherwise.
     */
    function has_permission($permission)
    {
    
        if( $this->session->userdata("logged_in") == FALSE || $this->session->userdata("user_name") == FALSE )
        {
            return FALSE;
        }
        
        $user_name = $this->session->userdata("user_name");
        
        $permissions = $this->config->item('permissions','users');
        
        if( isset($permissions[$user_name]) && in_array($permission,$permissions[$user_name]) )
        {
            return TRUE;
        }
    }
    
    /*
     * @return boolen - TRUE if user is logged in, FALSE otherwise
    */
    function is_logged_in()
    {
        return $this->session->userdata("logged_in") == "TRUE";
    }

}

?>
