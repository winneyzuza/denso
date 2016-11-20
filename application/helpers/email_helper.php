<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Element
 *
 * Lets you determine whether an array index is set and whether it has a value.
 * If the element is empty it returns FALSE (or whatever you specify as the default value.)
 *
 * @access	public
 * @param	string
 * @param	array
 * @param	mixed
 * @return	mixed	depends on what the array contains
 */
if ( ! function_exists('send_email'))
{
	function send_email($to, $subject, $message, $from = "",$as = "Admin")
	{
		$CI =& get_instance();
		
		if(!isset($from) || empty($from)){
			$from = "projectcodeigniter@gmail.com";
			$as = "Admin";
		}
		$CI->load->library('email');
        $CI->email->from($from,$as);
        $CI->email->to($to);
        $CI->email->subject($subject);
        $CI->email->message($message);
        @$CI->email->send();
	}
}