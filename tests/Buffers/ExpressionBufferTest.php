<?php

use Doge\Buffers\ExpressionBuffer;

class ExpressionBufferTest extends PHPUnit_Framework_TestCase {
    
    public function completeExpressions () {
        return [
            [['plz', 'strpos', 'with', '$arg']],
            [['$doge', 'is', 'test(10, 20, 30)']],
            [['plz', 'strpos', 'with', '(plz', 'substr', 'with', '$doge', '2)']],
            [
                ['plz', 'strpos', 'with', [
                    'plz', 'substr', 'with', '$doge', '2'
                ]]
            ]
        ];
    }
    
    public function uncompleteExpressions () {
        return [
            [['(plz', 'strpos', 'with', '(plz']],
            [['$doge', 'is', '(plz', 'test', 'with', '(plz', 'substr', 'with', '"cool")']],
            [
                ['plz', 'strpos', 'with', [
                    'plz', 'substr', 'with', '(plz', 'strpos', 'with', '2'
                ]]
            ]
        ];
    }
    
    /**
     * @dataProvider completeExpressions
     */
    public function testBufferIsComplete ($data) {
        $buffer = new ExpressionBuffer($data);
        
        $this->assertTrue($buffer->isComplete());
    }
    
    /**
     * @dataProvider uncompleteExpressions
     */
    public function testBufferIsntComplete ($data) {
        $buffer = new ExpressionBuffer($data);
        
        $this->assertFalse($buffer->isComplete());
    }
    
}