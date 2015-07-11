<?php
/**
 * Smarty {sdate} plugin
 * File: modifier.sdate.php
 * type: modifier
 * name: sdate
 * purpose: call the native php date function
 * 
 */
function smarty_modifier_sdate($string, $format = "r")
{
	if ($format == '') {
		$format = "r";
	}
    if (!isset($string)) {
        $string = time();
    }
    elseif (!is_numeric($string)) {
        $string = strtotime($string);
    }
    return date($format, $string);
}
