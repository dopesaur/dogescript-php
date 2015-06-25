<?php

use Doge\Buffer;

class BufferTest extends PHPUnit_Framework_TestCase {
    
    public function testAppend () {
        $buffer = new Buffer;
        
        $buffer->append('shh');
        $buffer->append('This is comment');
        
        $this->assertCount(2, $buffer->data());
        
        return $buffer;
    }
    
    /**
     * @depends testAppend
     */
    public function testClearAndEmpty ($buffer) {
        $buffer->clear();
        
        $this->assertCount(0, $buffer->data());
        $this->assertTrue($buffer->isEmpty());
    }
    
    public function testGetItem () {
        $buffer = new Buffer;
        $stuff  = 42;
        
        $buffer->append($stuff);
        
        $this->assertEquals($buffer->get(0), $stuff);
    }
    
}