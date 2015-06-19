<?php

use Doge\Parser;

class ParserTest extends PHPUnit_Framework_TestCase {
    
    private function createParser () {
        return new Parser(require dirname(__DIR__) . '/keywords.php');
    }
    
    public function parserProvider () {
        return require __DIR__ . '/resources/dogecode.php';
    }
    
    /**
     * @dataProvider parserProvider
     */
    public function testParser ($input, $output, $_, $__) {
        $parser = $this->createParser();
        $result = $parser->parse($input);
        
        $this->assertEquals($output, $result);
    }
    
}