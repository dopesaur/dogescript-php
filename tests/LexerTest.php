<?php

use Doge\Lexer;

class LexerTest extends PHPUnit_Framework_TestCase {
    
    public function createLexer () {
        return new Lexer(require dirname(__DIR__) . '/keywords.php');
    }
        
    public function lexerProvider () {
        return require __DIR__ . '/resources/dogecode.php';
    }
    
    /**
     * @dataProvider lexerProvider
     */
    public function testLexer ($_, $input, $output) {
        $lexer  = $this->createLexer();
        $result = $lexer->analyze($input);
        
        // var_dump($result);
        
        $this->assertEquals($output, $result);
    }
    
}