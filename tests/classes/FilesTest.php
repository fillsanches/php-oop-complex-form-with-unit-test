<?php

/**
 * A PHPUnit test case
 *
 * @author Fellipe Sanches <fellipes@yahoo.com.br>
 */

namespace Fellipe\Classes;
use PHPUnit\Framework\TestCase;

class FilesTest extends TestCase
{
    public function testCreateAFilesObject()
    {   
        $dir = __DIR__;

        $array = array(
            'file' => array(
                "tmp_name" => null,
                "name" => null,
                "size" => 1)
            );
                
        $attachment = new Files($array);
        $this->assertObjectHasAttribute('tmp_file_name', $attachment);
        $this->assertObjectHasAttribute('saved_file_name', $attachment);
        $this->assertObjectHasAttribute('saved_file_url', $attachment);
        $this->assertEquals(1, $attachment->saved_file_size);
    }
}