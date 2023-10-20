<?php

/*
 * jQuery File Upload Plugin PHP Class 7.1.4
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

class UploadHandler
{

    protected $options;

    protected $upload_director = '/backend/image/pictures/';

    // PHP File Upload error message codes:
    // http://php.net/manual/en/features.file-upload.errors.php
    protected $error_messages = array(
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk',
        8 => 'A PHP extension stopped the file upload',
        'post_max_size' => 'The uploaded file exceeds the post_max_size directive in php.ini',
        'max_file_size' => 'File is too big',
        'min_file_size' => 'File is too small',
        'accept_file_types' => 'Filetype not allowed',
        'max_number_of_files' => 'Maximum number of files exceeded',
        'max_width' => 'Image exceeds maximum width',
        'min_width' => 'Image requires a minimum width',
        'max_height' => 'Image exceeds maximum height',
        'min_height' => 'Image requires a minimum height',
        'abort' => 'File upload aborted',
        'image_resize' => 'Failed to resize image'
    );

    function __construct($options = null, $initialize = true, $error_messages = null, $folder)
    {

        $this->options = array(
            'user_dirs' => false,
            'mkdir_mode' => 0755,
            'param_name' => 'files',
            // Set the following option to 'POST', if your server does not support
            // DELETE requests. This is a parameter sent to the client:
            'delete_type' => 'POST',
            'access_control_allow_origin' => '*',
            'access_control_allow_credentials' => false,
            'access_control_allow_methods' => array(
                'OPTIONS',
                'GET',
                'POST',
                'PUT',
                'PATCH',
                'DELETE'
            ),
            'access_control_allow_headers' => array(
                'Content-Type',
                'Content-Range',
                'Content-Disposition'
            ),
            // Enable to provide file downloads via GET requests to the PHP script:
            //     1. Set to 1 to download files via readfile method through PHP
            //     2. Set to 2 to send a X-Sendfile header for lighttpd/Apache
            //     3. Set to 3 to send a X-Accel-Redirect header for nginx
            // If set to 2 or 3, adjust the upload_url option to the base path of
            // the redirect parameter, e.g. '/files/'.
            'download_via_php' => false,
            // Read files in chunks to avoid memory limits when download_via_php
            // is enabled, set to 0 to disable chunked reading of files:
            'readfile_chunk_size' => 10 * 1024 * 1024, // 10 MiB
            // Defines which files can be displayed inline when downloaded:
            'inline_file_types' => '/\.(gif|jpe?g|png)$/i',
            // Defines which files (based on their names) are accepted for upload:
            'accept_file_types' => '/.+$/i',
            // The php.ini settings upload_max_filesize and post_max_size
            // take precedence over the following max_file_size setting:
            'max_file_size' => null,
            'min_file_size' => 1,
            // The maximum number of files for the upload directory:
            'max_number_of_files' => null,
            // Defines which files are handled as image files:
            'image_file_types' => '/\.(gif|jpe?g|png)$/i',
            // Image resolution restrictions:
            'max_width' => null,
            'max_height' => null,
            'min_width' => 1,
            'min_height' => 1,
            // Set the following option to false to enable resumable uploads:
            'discard_aborted_uploads' => true,
            // Set to 0 to use the GD library to scale and orient images,
            // set to 1 to use imagick (if installed, falls back to GD),
            // set to 2 to use the ImageMagick convert binary directly:
            'image_library' => 0,
            // Uncomment the following to define an array of resource limits
            // for imagick:
            /*
            'imagick_resource_limits' => array(
                imagick::RESOURCETYPE_MAP => 32,
                imagick::RESOURCETYPE_MEMORY => 32
            ),
            */
            // Command or path for to the ImageMagick convert binary:
            'convert_bin' => 'convert',
            // Uncomment the following to add parameters in front of each
            // ImageMagick convert call (the limit constraints seem only
            // to have an effect if put in front):
            /*
            'convert_params' => '-limit memory 32MiB -limit map 32MiB',
            */
            // Command or path for to the ImageMagick identify binary:
            'identify_bin' => 'identify',
            'image_versions' => array(
                // The empty image version key defines options for the original image:
                '' => array(
                    // Automatically rotate images based on EXIF meta data:
                    'auto_orient' => true
                ),
                // Uncomment the following to create medium sized images:
                /*
                'medium' => array(
                    'max_width' => 800,
                    'max_height' => 600
                ),
                */
                'thumbnail' => array(
                    // Uncomment the following to use a defined directory for the thumbnails
                    // instead of a subdirectory based on the version identifier.
                    // Make sure that this directory doesn't allow execution of files if you
                    // don't pose any restrictions on the type of uploaded files, e.g. by
                    // copying the .htaccess file from the files directory for Apache:
                    //'upload_dir' => dirname($this->get_server_var('SCRIPT_FILENAME')).'/thumb/',
                    //'upload_url' => $this->get_full_url().'/thumb/',
                    // Uncomment the following to force the max
                    // dimensions and e.g. create square thumbnails:
                    //'crop' => true,
                    'max_width' => 200,
                    'max_height' => 200
                )
            )
        );

        if ($options) {
            $this->options = $options + $this->options;
        }
        if ($error_messages) {
            $this->error_messages = $error_messages + $this->error_messages;
        }
        if ($initialize) {
            $this->initialize();
        }
    }

    protected function initialize()
    {
        switch ($this->get_server_var('REQUEST_METHOD')) {
            case 'OPTIONS':
            case 'GET':
                $this->get();
                break;
            case 'PATCH':
            case 'PUT':
            case 'POST':
                $this->post();
                break;
            case 'DELETE':
                $this->delete();
                break;
            default:
                $this->header('HTTP/1.1 405 Method Not Allowed');
        }
    }

    protected function get_server_var($id)
    {
        return isset($_SERVER[$id]) ? $_SERVER[$id] : '';
    }

    protected function header($str)
    {
        header($str);
    }

    public function get()
    {

        $result = Files::orderBy('id', 'desc')
            ->where('filetype', 'image')
            ->paginate(30);

        $files = [];

        foreach ($result as $key => $value) {
            $obj = new stdClass();
            $obj->title = $value->title;
            $obj->name = $value->filename;
            $obj->url = "/backend/image/pictures/$value->filename";
            $obj->thumbnailUrl = "/backend/image/pictures/thumbnail/$value->filename";
            $obj->deleteUrl = "/admin/media/pictures?file=$value->id&_method=DELETE";
            $obj->deleteType = 'POST';
            $files['files'][] = $obj;
        }

        $json = @json_encode($files);

        echo $json;

        return true;
    }

    public function post($print_response = true)
    {

        if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
            return $this->delete($print_response);
        }

        $result = [

            $this->options['param_name'] => $this->generate_obj()

        ];

        echo json_encode($result);

        return true;

    }

    public function delete()
    {

        $find = Files::find(Input::get('file'));

        $response[$find->id] = true;

        $file_name = $find->filename;

        if (is_file($this->upload_director . $file_name)) {

            unlink($this->upload_director . $file_name);

            unlink($this->upload_director . 'thumbnail/' . $file_name);

        }

        $find->delete();

        echo json_encode($response);

        return true;

    }

    public function generate_obj()
    {

        $file = Input::file('files');

        $filename = str_random(15) . '.' . $file[0]->getClientOriginalExtension();

        $name = $file[0]->getClientOriginalName();

        $last = Files::create([
            'title' => $name,
            'filename' => $filename,
            'filetype' => 'image'
        ]);

        $data = new stdClass();
        $data->name = $filename;
        $data->size = $file[0]->getSize();
        $data->type = $file[0]->getMimeType();
        $data->id = $last->id;
        $data->url = '/backend/image/pictures/' . $filename;
        $data->thumbnailUrl = '/backend/image/pictures/thumbnail/' . $filename;
        $data->deleteUrl = '/admin/media/pictures?file=' . $last->id . '&_method=DELETE';
        $data->deleteType = 'POST';

        $files[] = $data;

        Image::make($file[0]->getRealPath())->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        })
            ->save(public_path('backend/image/pictures/thumbnail/' . $filename));

        $file[0]->move(public_path('backend/image/pictures'), $filename);

        return $files;

    }

}
