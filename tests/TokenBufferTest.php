<?php

use Doge\TokenBuffer;

class TokenBufferTest extends PHPUnit_Framework_TestCase {
    
    private function createBuffer () {
        return new TokenBuffer(require dirname(__DIR__) . '/keywords.php');
    }
    
    public function testAppend () {
        $buffer = $this->createBuffer();
        
        $buffer->append('shh');
        $buffer->append('This is comment');
        
        $this->assertCount(2, $buffer->tokens());
        
        return $buffer;
    }
    
    /**
     * @depends testAppend
     */
    public function testClearAndEmpty ($buffer) {
        $buffer->clear();
        
        $this->assertCount(0, $buffer->tokens());
        $this->assertTrue($buffer->isEmpty());
    }
    
    public function testUnfinishedTokens () {
        $buffer = $this->createBuffer();
        
        $buffer->append('\'String');
        $buffer->append('something');
        $buffer->append('else');
        
        $this->assertTrue($buffer->isUnfinished());
        
        return $buffer;
    }
    
    /**
     * @depends testUnfinishedTokens
     */
    public function testFinishedTokens ($buffer) {
        $buffer->append('yolo\'');
        
        $this->assertFalse($buffer->isUnfinished());
    }
    
    public function testFinishedArrayTokens () {
        $buffer = $this->createBuffer();
        
        $buffer->append('[1,');
        $buffer->append('2,');
        
        $this->assertFalse($buffer->isFinished());
        
        $buffer->append('3]');
        
        $this->assertTrue($buffer->isFinished());
    }
    
}