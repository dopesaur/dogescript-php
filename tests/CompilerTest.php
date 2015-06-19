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
    public function testCompiler ($_, $__, $input, $output) {
        $compiler = $this->createCompiler();
        $result   = str_replace("\n", '', $compiler->compile($input));
        
        // $this->assertTrue(true);
        $this->assertEquals($output, $result);
    }
    
}