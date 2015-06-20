<?php

use Doge\Statement;

class StatementTest extends PHPUnit_Framework_TestCase {
    
    public function testStatement () {
        $token    = 'plz';
        $operands = ['abc'];
        
        $statement = new Statement($token, $operands);
        
        $this->assertEquals($token, $statement->getToken());
        $this->assertEquals($operands, $statement->getOperands());
    }
    
    public function testAddOperand () {
        $token = 'is';
        $operands = ['$abc'];
        
        $statement = new Statement($token, $operands);
        $statement->addOperand('10');
        
        $this->assertEquals(['$abc', '10'], $statement->getOperands());
    }
    
    public function testToArray () {
        $token = 'such';
        $operands = ['test'];
        
        $statement = new Statement($token, $operands);
        
        $this->assertEquals([$token, $operands], $statement->toArray());
    }
    
    public function testToArrayRecursive () {
        $token = 'such';
        $operands = ['test', new Statement('much', ['10'])];
        
        $statement = new Statement($token, $operands);
        
        $this->assertEquals(
            [$token, ['test', ['much', ['10']]]], 
            $statement->toArray()
        );
    }
    
}