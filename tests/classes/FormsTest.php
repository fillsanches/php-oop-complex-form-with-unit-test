<?php

/**
 * A PHPUnit test case
 *
 * @author Fellipe Sanches <fellipes@yahoo.com.br>
 */

namespace Fellipe\Classes;
use PHPUnit\Framework\TestCase;

class FormsTest extends TestCase 
{
    public function testCreateAFormObject()
    {
        $form = new Forms('new_form');
        $this->assertEquals($form->form_name, $form->getFormName());
        $this->assertEquals(null, $form->response_message);
    }

    public function testSetAFormName()
    {
        $form = new Forms('new_form');
        $this->assertEquals($form->form_name, $form->getFormName());
    }

    public function testGenerateFormAttributes()
    {
        $form = new Forms('new_form');
        $array = array('new_key', 'new_value');
        $form->generateAttributes($array);
        $value = 'new_value';
        $this->assertContains($value, $array);
    }
}