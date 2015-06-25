<?php

use Doge\Compilers\PHP as Compiler;

class CompilerTest extends PHPUnit_Framework_TestCase {
    
    public function createCompiler () {
        return new Compiler(require dirname(__DIR__) . '/keywords.php');
    }
        
    public function compilerProvider () {
        return require __DIR__ . '/resources/dogecode.php';
    }
    
    /**
     * @dataProvider compilerProvider
     */
    public function testCompiler ($_, $_, $input, $output) {
        $compiler = $this->createCompiler();
        
        // Remove trailing new lines and <?php 
        $result = substr(trim($compiler->compile($input)), 7);
        
        $this->assertEquals($output, $result);
    }
    
}