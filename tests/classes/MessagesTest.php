<?php

/**
 * A PHPUnit test case
 *
 * @author Fellipe Sanches <fellipes@yahoo.com.br>
 */

namespace Fellipe\Classes;
use PHPUnit\Framework\TestCase;

class MessagesTest extends TestCase
{
    public function testCreateAMessagesObject()
    {   
        $messages_file = getcwd() . '/config/messages.json';
        $messages = new Messages($messages_file);
        $this->assertObjectHasAttribute('has_blank_fields', $messages);
    }

    public function testVerifyIfTheMessagesInTheJsonFileHaveChanged()
    {   
        $messages_file = getcwd() . '/config/messages.json';
        $messages = new Messages($messages_file);

        $this->assertEquals(8, $messages->total_messages);
        $this->assertObjectHasAttribute('has_blank_fields', $messages);
        $this->assertObjectHasAttribute('has_invalid_email', $messages);
        $this->assertObjectHasAttribute('has_invalid_phone', $messages);
        $this->assertObjectHasAttribute('has_no_attachment', $messages);
        $this->assertObjectHasAttribute('has_invalid_attachment_type', $messages);
        $this->assertObjectHasAttribute('has_invalid_attachment_size', $messages);
        $this->assertObjectHasAttribute('email_sent_successfully', $messages);
        $this->assertObjectHasAttribute('sending_failed', $messages);
    }
}