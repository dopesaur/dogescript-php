<?php namespace Doge;

use Doge\Compilers\PHP;

class Kernel {
    
    static function doge ($file) {
        if (!file_exists($file)) {
            throw new Exception("File '$file' not exists!");
        }
        
        $grammar = require dirname(__DIR__) . '/keywords.php';
        
        $code = file_get_contents($file);
        
        $parser = new Parser;
        
        $lexer    = new Lexer($grammar);
        $compiler = new PHP($grammar);
        
        return $compiler->compile($lexer->analyze($parser->parse($code)));
    }
    
}