<?php

/**
 * A PHPUnit test case
 *
 * @author Fellipe Sanches <fellipes@yahoo.com.br>
 */

namespace Fellipe\Classes;
use PHPUnit\Framework\TestCase;

class FormsValidationTest extends TestCase
{
    public function testCreateAFormValidationObject()
    {
        $formValidation = new FormsValidation();
        $this->assertEquals(false, $formValidation->error);
    }

    public function testVerifyTheRuleForFormHasAnInvalidEmail()
    {
        $formValidation = new FormsValidation();
        $this->assertEquals(false, $formValidation->hasInvalidEmail('mail@provider.com.br'));
        $this->assertEquals(true, $formValidation->hasInvalidEmail('mail#provider.com.br'));
    }

    public function testVerifyTheRuleForFormHasAnInvalidPhone()
    {
        $formValidation = new FormsValidation();
        $this->assertEquals(false, $formValidation->hasInvalidPhone('(21)98888-7777'));
        $this->assertEquals(false, $formValidation->hasInvalidPhone('21-988887777'));
        $this->assertEquals(true, $formValidation->hasInvalidPhone('11111'));
    }

    public function testVerifyTheRuleForFormHasNoAttachment()
    {
        $allowed_types = array('pdf', 'doc');
        $array1['file']['name'] = 'test.pdf';
        $array2['file']['name'] = 'test.jpg';
        $formValidation = new FormsValidation();
        $assert1 = $formValidation->hasInvalidAttachmentType($array1, $allowed_types);
        $this->assertEquals(false, $assert1);
        $assert2 = $formValidation->hasInvalidAttachmentType($array2, $allowed_types);
        $this->assertEquals(true, $assert2);
    }
}

