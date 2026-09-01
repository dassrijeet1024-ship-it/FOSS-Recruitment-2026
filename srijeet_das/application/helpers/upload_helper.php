<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('upload_file')) 
{
    function upload_file($file_field, $upload_path, $width="", $height="") 
	{
        $CI = &get_instance();
        $CI->load->library('upload');

        // Upload configuration
        $config['upload_path']   = './uploads/'.$upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 4096;

		$config['file_name'] = uniqid(); // Generate a unique file name

        $CI->upload->initialize($config);

        if ($CI->upload->do_upload($file_field)) 
		{
            $upload_data = $CI->upload->data(); // Uploaded file data

            // Resize image and replace original
            if ($width!="" || $height!="") 
            {
                resize_image($upload_data['full_path'], $upload_data['full_path'], $width, $height);
            }
			
			return ['status' => true, 'data' => $CI->upload->data()];
        }
		else
		{
            return ['status' => false, 'error' => $CI->upload->display_errors()];
        }
    }
}

if (!function_exists('upload_pimage')) 
{
    function upload_pimage($file_field, $survey_type) 
	{
        $CI = &get_instance();
        $CI->load->library('upload');
		
		$mY = date('mY');
		$directory = "./uploads/".$survey_type."/pimage/".$mY;
		
		if (!file_exists($directory)) 
		{
			mkdir($directory, 0777, true); // Create directory with full permissions
		}

        $config['upload_path']   = $directory;
        $config['allowed_types'] = 'jpg';
        $config['max_size']      = $CI->config->item('max_size');
		$config['file_name'] 	 = uniqid();
        $CI->upload->initialize($config);

        if ($CI->upload->do_upload($file_field)) 
		{
            $upload_data = $CI->upload->data(); // Uploaded file data
            resize_image($upload_data['full_path'], $upload_data['full_path'], $CI->config->item('pimage_width'));
			return ['status'=>true,'data'=>$CI->upload->data(),'mY'=>$mY];
        }
		else
		{
            return ['status'=>false,'error'=>$CI->upload->display_errors()];
        }
    }
}
if (!function_exists('upload_simage')) 
{
    function upload_simage($file_field, $survey_type) 
	{
        $CI = &get_instance();
        $CI->load->library('upload');
		
		$mY = date('mY');
		$directory = "./uploads/".$survey_type."/simage/".$mY;
		
		if (!file_exists($directory)) 
		{
			mkdir($directory, 0777, true); // Create directory with full permissions
		}

        $config['upload_path']   = $directory;
        $config['allowed_types'] = 'jpg';
        $config['max_size']      = $CI->config->item('max_size');
		$config['file_name'] 	 = uniqid();
        $CI->upload->initialize($config);

        if ($CI->upload->do_upload($file_field)) 
		{
            $upload_data = $CI->upload->data(); // Uploaded file data
            resize_image($upload_data['full_path'], $upload_data['full_path'], $CI->config->item('simage_width'));
			return ['status'=>true,'data'=>$CI->upload->data(),'mY'=>$mY];
        }
		else
		{
            return ['status'=>false,'error'=>$CI->upload->display_errors()];
        }
    }
}

if (!function_exists('resize_image')) 
{
    function resize_image($source_path, $destination_path, $width, $height) 
    {
        $CI = &get_instance();
        $CI->load->library('image_lib');

        $config['image_library']  = 'gd2';
        $config['source_image']   = $source_path;
        $config['new_image']      = $destination_path; // Overwrite original image
        $config['maintain_ratio'] = TRUE;
        $config['width']          = $width;
        $config['height']         = $height;

        $CI->image_lib->initialize($config);

        if (!$CI->image_lib->resize()) 
        {
            return $CI->image_lib->display_errors();
        }

        $CI->image_lib->clear();
    }
}
