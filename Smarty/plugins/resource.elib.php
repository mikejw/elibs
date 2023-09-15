<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     resource.elib.php
 * Type:     resource
 * Name:     elib
 * Purpose:  Fetches template from your ELib directory
 *           if not found in $template_dir
 * -------------------------------------------------------------
 */

function smarty_resource_elib_source($tpl_name, &$tpl_source, $smarty)
{
    $filename = $smarty->_joined_template_dir.'/'.$tpl_name;

    if (!file_exists($filename)) {
        if (isset($smarty->tpl_vars['elibtpl_arr'])) {


            foreach ($smarty->tpl_vars['elibtpl_arr']->value as $dir) {

                $filename = $dir.'/'.$tpl_name;
                if (file_exists($filename)) {
                    break;
                }
            }
        } else {

            $filename = $smarty->tpl_vars['elibtpl']->value.$tpl_name;
            if (!file_exists($filename)) {
                return false;
            }
        }
    }

    if ($fp = fopen($filename, 'rb')) {
        $tpl_source = fread($fp, filesize($filename));
        fclose($fp);
        return true;
    }

    return false;
}

function smarty_resource_elib_timestamp($tpl_name, &$tpl_timestamp, $smarty)
{
    $filename = $smarty->_joined_template_dir.'/'.$tpl_name;

    if (!file_exists($filename)) {
        if (isset($smarty->tpl_vars['elibtpl_arr'])) {

            foreach ($smarty->tpl_vars['elibtpl_arr']->value as $dir) {
                $filename = $dir.'/'.$tpl_name;
                if (file_exists($filename)) {
                    break;
                }
            }
        } else {
            $filename = $smarty->tpl_vars['elibtpl']->value.$tpl_name;
        }
    }

    if (isset($filename)) {
        $tpl_timestamp = filemtime($filename);
        $tpl_timestamp = time();
        return true;
    }
    return false;
}

function smarty_resource_elib_secure($tpl_name, &$smarty)
{
    return true;
}

function smarty_resource_elib_trusted($tpl_name, &$smarty)
{
    // not used for templates
}
