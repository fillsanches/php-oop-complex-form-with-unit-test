<?php
namespace Fellipe\Classes;

/**
 * A class for working with form validation
 *
 * @author Fellipe Sanches <fellipes@yahoo.com.br>
 */

class FormsValidation
{
    public $error = false;
    public $data;

    /**
     * Returns true if it finds errors, then set $error attribute to true
     */
    public function hasBlankFields($array) : bool
    {      
        return (in_array('', $array, true) || in_array(null, $array, true)) ? true && $this->setError(true) : false;
    }

    /**
     * Returns true if it finds errors, then set $error attribute to true
     */    
    public function hasInvalidEmail($string) : bool
    {
        return (filter_var($string, FILTER_VALIDATE_EMAIL)) ? false : true && $this->setError(true);
    }

    /**
     * Returns true if it finds errors, then set $error attribute to true
     * Phone format 99-?9999-9999
     * Remove non-numeric characters before comparing
     */    
    public function hasInvalidPhone($string) : bool
    {
        $nums = strlen(
            preg_replace(
                "/[^0-9]/", "", $string
            )
        );        
        return ($nums < 10 || $nums > 11) ? true && $this->setError(true) : false;
    }

    /**
     * Returns true if it finds errors, then set $error attribute to true
     */    
    public function hasNoAttachment($array) : bool
    {
        return !(empty($array['file']['name'])) ? false : true && $this->setError(true);
    }    

    /**
     * Returns true if it finds errors, then set $error attribute to true
     */    
    public function hasInvalidAttachmentType($array, $allowed_types) : bool
    {
        $basename = basename($array['file']['name']);
        $pathinfo = pathinfo($basename); //pdf
        $file_type = $pathinfo['extension'];
        return (in_array($file_type, $allowed_types)) ? false : true && $this->setError(true);
        //return $file_type;
    }   

    /**
     * Get the value of error
     */ 
    public function getError()
    {
        return $this->error;
    }

    /**
     * Set the value of error
     *
     * @return  self
     */ 
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }
}
