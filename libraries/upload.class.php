<?php
/**
 *------------------------------------------------------
 * Photon microframework
 *
 * @class upload
 * @author Soliman Adel (Mr-simple)
 * @email {soliman.adelzx@gmail.com}
 * @version v1.0
 *------------------------------------------------------
 */

class upload
{
    public $errors = array();

    protected $options = array(
        'upload_dir' => 'uploads/images',
        'extensions' => array(
            'png',
            'jpeg',
            'jpg',
            'gif',
            'ico',
            'json'
        ),
        'file_name' => false,
        'max_file_size' => 3 * (1024 * 1024),
        'rename' => false,
    );

    private $has_error = false;
    private $error_messages = array(
        0 => 'There is no error, the file uploaded with success.',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
        3 => 'The uploaded file was only partially uploaded.',
        4 => 'No file was uploaded.',
        6 => 'Missing a temporary folder.',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload',
        9 => 'File %s type not allowed.',
        10 => 'File %s size bigger than %d MB.'
    );

    function __construct(array $options = NULL)
    {
        // Directory upload validation.
        if( !file_exists($this->options['upload_dir'])
            && !is_dir($this->options['upload_dir'])
        ) {
            @mkdir($this->options['upload_dir'], 750, true);
        }
        if( !is_writable($this->options['upload_dir']) ) {
            @chmod($this->options['upload_dir'], 750);
        }
        if ( !empty($options) ) {
            $this->options = array_merge($this->options, $options);
        }
    }

    /**
     * config
     * override the default configuration.
     *
     * @param array
     * @return void
     */
    function config(array $options = NULL)
    {
        if ( !empty($options) ) {
            $this->options = array_merge($this->options, $options);
        }
        return $this;
    }

    /**
     * rename
     * Override uploaded file name.
     *
     * @param null
     * @return string
     */
    private function rename()
    {
        if( empty($this->options['file_name']) ) {
            return round(microtime(true));
        } else {
            return strtolower($this->options['file_name']);
        }
    }

    /**
     * set_error
     * Set custom error.
     *
     * @param mixed {string | null}
     * @return void
     */
    function set_error($error = NULL)
    {
        $this->has_error = true;
        if( intval($error) ) $error = $this->error_messages[$error];
        $this->errors[] = $error;
        return false;
    }

    function upload($userfile = null)
    {
        // Files array
        $files_array = $_FILES[$userfile];

        // IF we upload multiple files.
        if (
            is_array($files_array)
            &&
            is_array($files_array["tmp_name"])
        ) {

            // Loop files array.
            foreach ($files_array["error"] as $key => $error) {

                // IF everything is ok.
                if( 0 == $error && UPLOAD_ERR_OK == $error ) {

                    $tmp_name = $files_array["tmp_name"][$key];
                    $type = $files_array["type"][$key];
                    $extension = (explode("/", $type))[1];
                    $name = (
                        ($this->options['rename'])
                    ) ? $this->rename().".".$extension : $files_array["name"][$key];

                    $size = $files_array["size"][$key];

                    if( empty($tmp_name) ) return false;

                    // IF file type not allowed.
                    if( !in_array($extension, $this->options["extensions"]) ) {
                        $error = sprintf(
                            $this->error_messages[9],
                            $name
                        );
                        $this->set_error($error);
                    }

                    // IF file size bigger than default configuration.
                    if( $size > $this->options["max_file_size"] ) {
                        $error = sprintf(
                            $this->error_messages[10],
                            $name,
                            $this->formatSize($this->options["max_file_size"])
                        );
                        $this->set_error($error);
                    }

                    if( is_uploaded_file($tmp_name) ) {
                        if(
                            move_uploaded_file(
                                $tmp_name,
                                $this->options["upload_dir"]."/".$name
                            )
                        ) {
                            $uploaded_file = $this->options["upload_dir"]."/".$name;
                            chmod($this->options["upload_dir"].'/'.$name, 0755);
                            $files_array["size"][] = $this->formatSize($size);
                            $files_array["extension"][] = $extension;
                            $files_array["path"][] = $this->options["upload_dir"].'/'.$name;
                        }
                    }

                } else {
                    $this->set_error($error);
                }

            }

        } else {
            // IF we upload one single file.
            $tmp_name = $files_array["tmp_name"];
            $name = $files_array["name"];
            $error = $files_array["error"];
            $type = $files_array["type"];
            $extension = (explode("/", $type))[1];
            $name = (
                ($this->options['rename'])
            ) ? $this->rename().".".$extension
            : $files_array["name"];

            $size = $files_array["size"];

            if( empty($tmp_name) ) return false;

            // IF file type not allowed.
            if( !in_array($extension, $this->options["extensions"]) ) {
                $error = sprintf(
                    $this->error_messages[9],
                    $name
                );
                $this->set_error($error);
            }

            // IF the file size bigger than the default configuration.
            if( $size > $this->options["max_file_size"] ) {
                $error = sprintf(
                    $this->error_messages[10], $name,
                    $this->formatSize($this->options["max_file_size"])
                );
                $this->set_error($error);
            }

            // IF everything is ok.
            if( 0 == $error && UPLOAD_ERR_OK == $error ) {

                if( is_uploaded_file($tmp_name) ) {
                    if(
                        move_uploaded_file(
                            $tmp_name,
                            $this->options["upload_dir"].'/'.$name
                        )
                    ) {
                        chmod($this->options["upload_dir"].'/'.$name, 0755);
                        $uploaded_file = $this->options["upload_dir"]."/".$name;
                        $files_array["size"] = $this->formatSize($size);
                        $files_array["path"] = $uploaded_file;
                    }
                }

            } else {
                $this->set_error($error);
            }
        }

        return $files_array;

    }


    /**
     * formatSize
     * Return file size in formatted text.
     *
     * @param int
     * @return string
     */
    private function formatSize($bytes)
    {
        if ($bytes >= 1073741824){
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }elseif ($bytes >= 1048576){
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }elseif ($bytes > 0){
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }else{
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    /**
     * has_error
     * Check if the uploading process has an error.
     *
     * @param NULL
     * @return INT
     */
    function has_error()
    {
        return $this->has_error;
    }

    /**
     * errors
     * Return errors array.
     *
     * @param void
     * @return array
     */
    function errors()
    {
        return $this->errors;
    }
}

?>
