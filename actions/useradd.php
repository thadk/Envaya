<?php

	/**
	 * Elgg add action
	 * 
	 * @package Elgg
	 * @subpackage Core
	 * @author Curverider Ltd
	 * @link http://elgg.org/
	 */

	require_once(dirname(dirname(__FILE__)) . "/engine/start.php");

	admin_gatekeeper(); // Only admins can add a user
	action_gatekeeper();
	
	// Get variables
	global $CONFIG;
	$username = get_input('username');
	$password = get_input('password');
	$password2 = get_input('password2');
	$email = get_input('email');
	$name = get_input('name');
	
	$admin = get_input('admin');
	if (is_array($admin)) $admin = $admin[0];
    
	// For now, just try and register the user
	try {
		if (
			(
				(trim($password)!="") &&
				(strcmp($password, $password2)==0) 
			) &&
			($guid = register_user($username, $password, $name, $email, true))
		) {
			$new_user = get_entity($guid);
			if (($guid) && ($admin != null))
            {
				$new_user->admin = true;
            }    
			
			$new_user->admin_created = true;
			$new_user->created_by_guid = get_loggedin_userid();
			$new_user->save();
			
			notify_user($new_user->guid, $CONFIG->site_guid, elgg_echo('useradd:subject'), sprintf(elgg_echo('useradd:body'), $name, $CONFIG->sitename, $CONFIG->url, $username, $password));
			
			system_message(sprintf(elgg_echo("adduser:ok"),$CONFIG->sitename));
		} else {
			action_error(elgg_echo("adduser:bad"));
		}
	} catch (RegistrationException $r) 
    {
		action_error($r->getMessage());
	}

	forward($_SERVER['HTTP_REFERER']);
	exit;
?>