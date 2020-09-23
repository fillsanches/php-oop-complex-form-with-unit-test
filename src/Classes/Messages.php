<?php

/**
 * A class for working with messages
 *
 * @author Fellipe Sanches <fellipes@yahoo.com.br>
 */

namespace Fellipe\Classes;

class Messages
{
    
    public $total_messages;

    /**
     * Define all attributes of a Messages object from a json file.
     */    
    function __construct($messages_file)
    {
        $messages = json_decode(file_get_contents($messages_file));
        
        foreach ($messages->messages as $key => $value) {
            $this->$key = $value;
            $this->total_messages++;
        }
        
    }
}