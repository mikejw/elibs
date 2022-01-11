<?php
/**
 * Smarty {blog_images} plugin
 * File: modifier.blog_images.php
 * type: modifier
 * name: blog_images
 * purpose: create images from placeholders
 *
 */
function smarty_modifier_blog_images($string, $web_root, $public_dir)
{
  return preg_replace_callback('/\[blog-image\:([A-Za-z0-9=]*)\]/',
    function($matches) use ($web_root, $public_dir) {
      $data = json_decode(base64_decode($matches[1]));
      return '<img class="'
        . $data->centered
        . ' '
        . $data->fluid
        . '" src="//'
        . $web_root
        . $public_dir
        . '/uploads/'
        . $data->size
        . $data->filename
        . '" alt=""'
        . ' data-payload="'
        . $matches[1]
        . '" />';
    },
    $string
  );
}
