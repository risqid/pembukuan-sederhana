<?php

function is_logged_in_sp()
{
	// to call code igniter's libraries inside this function
	// ubtuk memanggil library code igniter di dalam fungsi ini
	$ci = get_instance();

	// if user hasn't logged in,then redirect to auth(login page)
	// prevent user from directly entering page by inputting using url
	if (!$ci->session->userdata('username_sp')) {
		redirect('auth');
	}
}
