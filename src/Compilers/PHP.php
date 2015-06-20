<?php namespace Doge\Compilers;

use Doge\Base;
use Doge\Compiler;

class PHP extends Base implements Compiler {
    
    public function compile ($tokens) {
        $code = '';
        
        // var_dump($tokens);
        
        foreach ($tokens as $line) {
            $code .= $this->compileLine($line) . "\n";
        }
        
        return trim($code);
    }
    
    private function compileLine ($line) {
        // var_dump($line);
        
        // return $this->compileToken();
    }
    
    private function compileToken ($token, $index, $line) {
        
    }
    
}