<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Users, passwords and permissions configuration.
*/

$config['users']['passwords'] = array(
    "----" => "----"
);

$config['users']['permissions'] = array(
    "----" => array(
        "itemised_bill_emailer",
        "tracker",
        "tracker_delete"
    )
);

?>
