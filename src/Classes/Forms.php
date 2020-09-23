<?php
namespace Fellipe\Classes;

/**
 * A class for working with forms
 *
 * @author Fellipe Sanches <fellipes@yahoo.com.br>
 */

class Forms
{
    public $form_name;
    public $response_message;
    public $client_ip_address;
    public $client_proxied_ip_address;

    /**
     * Define some attributes of a Forms object.
     */
    function __construct($form_name)
    {
        $this->form_name = $this->setFormName($form_name);
        $this->response_message = null;
        $this->client_ip_address = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : null; //only returns null from phpunit
        $this->client_proxied_ip_address = (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : null;
    }

    /**
     * Define some attributes of a Forms object.
     * 
     * @param array $fields Receive the $_POST array
     * @param array $attachment Receive the $_FILES array
     */
    function generateAttributes($fields, $attachment = null) : void
    {
        foreach ($fields as $key => $value)
        $this->$key = $value;
        $this->all = $fields;
        $this->attachment = $attachment;
    }

    /**
     * Get the value of form_name
     */ 
    public function getFormName()
    {
        return $this->form_name;
    }

    /**
     * Set the value of form_name
     *
     * @return  self
     */ 
    public function setFormName($form_name)
    {
        $this->form_name = $form_name;

        return $this;
    }

    /**
     * Get the value of response_message
     */ 
    public function getResponseMessage()
    {
        return $this->response_message;
    }

    /**
     * Set the value of response_message
     *
     * @return  self
     */ 
    public function setResponseMessage($response_message)
    {
        $this->response_message = $response_message;

        return $this;
    }

    /**
     * Get the value of client_ip_address
     */ 
    public function getClientIpAddress()
    {
        return $this->client_ip_address;
    }

    /**
     * Set the value of client_ip_address
     *
     * @return  self
     */ 
    public function setClientIpAddress($client_ip_address)
    {
        $this->client_ip_address = $client_ip_address;

        return $this;
    }

    /**
     * Get the value of client_proxied_ip_address
     */ 
    public function getClientProxiedIpAddress()
    {
        return $this->client_proxied_ip_address;
    }

    /**
     * Set the value of client_proxied_ip_address
     *
     * @return  self
     */ 
    public function setClientProxiedIpAddress($client_proxied_ip_address)
    {
        $this->client_proxied_ip_address = $client_proxied_ip_address;

        return $this;
    }
}