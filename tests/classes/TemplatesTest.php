<?php

/**
 * A PHPUnit test case
 *
 * @author Fellipe Sanches <fellipes@yahoo.com.br>
 */

namespace Fellipe\Classes;
use PHPUnit\Framework\TestCase;

class TemplatesTest extends TestCase
{
    public function testCreateATemplateObject()
    {
        $template_test = new Templates;
        $this->assertObjectHasAttribute('template_rendered', $template_test);
    }

    public function testVerifyIfTheMailTemplateExistsAndHasChanged()
    {   
        $template_dir = getcwd() . '/templates/mail.tpl';
        $template_test = new Templates;
        $template_test->renderTemplate(
            $template_dir, array(
                'name' => 'a_name', 
                'email' => 'an_email', 
                'phone' => 'a_phone', 
                'saved_file_name' => 'a_saved_file_name', 
                'message' => 'a_message0'
            )
        );

        $this->assertContains('a_name', $template_test->template_rendered);
        $this->assertContains('an_email', $template_test->template_rendered);
        $this->assertContains('a_phone', $template_test->template_rendered);
        $this->assertContains('a_saved_file_name', $template_test->template_rendered);
        $this->assertContains('a_message', $template_test->template_rendered);
    }
}