<?php

function delete_cache_by_prefix($prefix)
{
    $CI =& get_instance();
    $CI->load->helper('file');

    $cache_path = APPPATH . 'cache/';

    $files = get_filenames($cache_path);

    foreach ($files as $file)
    {
        $full_path = $cache_path . $file;

        // Read file content (CI stores key inside file)
        $content = file_get_contents($full_path);

        if (strpos($content, $prefix) !== FALSE)
        {
            @unlink($full_path);
        }
    }
}