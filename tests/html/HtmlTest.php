<?php

/**
 * A PHPUnit test case
 *
 * @author Fellipe Sanches <fellipes@yahoo.com.br>
 */

use PHPUnit\Framework\TestCase;

class HtmlTest extends TestCase
{
    public function testVerifyIfImportantHtmlTagsIdHaveChanged()
    {
        $contact_html_file_path = getcwd() . '/src/contact_form.html';
        $returned_external_html = file_get_contents($contact_html_file_path);
        //echo $returned_external_html;
        $dom_doc = new DOMDocument();
        $dom_doc->loadHTML($returned_external_html);
        
        $contact_form_status_msg = $dom_doc->getElementById('contactFormstatusMsg');
        $this->assertEquals('div', $contact_form_status_msg->nodeName);
        
        $contact_form = $dom_doc->getElementById('contactForm');
        $this->assertEquals('form', $contact_form->nodeName);

        $name = $dom_doc->getElementById('name');
        $this->assertEquals('input', $name->nodeName);

        $email = $dom_doc->getElementById('email');
        $this->assertEquals('input', $email->nodeName);

        $phone = $dom_doc->getElementById('phone');
        $this->assertEquals('input', $phone->nodeName);

        $file = $dom_doc->getElementById('file');
        $this->assertEquals('input', $file->nodeName);

        $message = $dom_doc->getElementById('message');
        $this->assertEquals('input', $message->nodeName);

        $submit = $dom_doc->getElementById('submit');
        $this->assertEquals('input', $submit->nodeName);
    }

    public function testVerifyIfFormInputsAreAddedOrRemoved()
    {
        $contact_html_file_path = getcwd() . '/src/contact_form.html';
        $returned_external_html = file_get_contents($contact_html_file_path);

        $dom_doc = new DOMDocument();
        $dom_doc->loadHTML($returned_external_html);
        
        //last known quantity of fields on form
        $quantity_of_fields = 6;

        $contact_form_fields = $dom_doc->getElementsByTagName('input');
        $this->assertEquals($quantity_of_fields, count($contact_form_fields));
    }
}