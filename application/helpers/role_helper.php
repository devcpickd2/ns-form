<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function user_type()
{
	$CI =& get_instance();
	return $CI->session->userdata('type');
}

function is_admin()
{
	return user_type() === 0;
}

function is_manager()
{
	return user_type() === 1;
}

function is_spv()
{
	return user_type() === 2;
}

function is_foreman()
{
	return user_type() === 3;
}

function is_qc()
{
	return user_type() === 4;
}

function is_enginer()
{
	return user_type() === 5;
}

function is_wh()
{
	return user_type() === 6;
}

function is_lab()
{
	return user_type() === 7;
}

?>