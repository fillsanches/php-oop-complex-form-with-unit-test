<?php

/**
 * A class for working with files
 *
 * @author Fellipe Sanches <fellipes@yahoo.com.br>
 */

namespace Fellipe\Classes;

class Files
{
    public $tmp_file_name;
    public $saved_file_name;
    public $saved_file_url;
    public $saved_file_size;

    /**
     * Define some attributes of a Files object.
     */
    function __construct($array)
    {
        $this->tmp_file_name = $array["file"]["tmp_name"];
        $this->saved_file_name = time() . '-' . $array["file"]["name"];
        $this->saved_file_size = $array["file"]["size"];
    }

    /**
     * Moves an uploaded file from its temporary directory to its definitive one. 
     * Then define some attributes of a Files object.
     * 
     * @param string $path
     */
    public function uploadFile($path) : bool
    {
        $this->saved_file_url = $path . $this->saved_file_name;
        return move_uploaded_file($this->tmp_file_name, $this->saved_file_url);
    }
}