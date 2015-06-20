<?php namespace Doge\Compilers;

use Doge\Base;
use Doge\Compiler;

class PHP extends Base implements Compiler {
    
    public function compile ($tokens) {
        $code = '';
        
        foreach ($tokens as $line) {
            if (empty($line)) {
                continue;
            }
            
            $code .= $this->compileLine($line) . "\n";
        }
        
        return $code;
    }
    
    private function compileLine ($line) {
        list($token, $arguments) = $line;
        
        return $this->compileToken($token, $arguments);
    }
    
    private function compileToken ($token, $arguments) {
        if ($token === 'shh') {
            return '// ' . implode(' ', $arguments);
        }
        
        if ($token === 'such') {
            return 'function ' 
                . current($arguments) 
                . $this->compileArguments($token, $arguments[1]);
        }
        
        if ($token === 'wow') {
            $code = '';
            
            if (!empty($arguments)) {
                $code = 'return ' . implode(' ', $arguments) . ';';
            }
            
            return $code . "\n}";
        }
        
        if ($token === 'plz') {
            return current($arguments) 
                . '(' 
                . $this->compileArguments($token, $arguments[1]) 
                . ');';
        }
        
        if ($token === 'quiet') {
            return '/* ' . '';
        }
        
        if ($arguments[0] === 'is') {
            return $token . ' ' . $this->compileArguments('', $arguments);
        }
        
        return '';
    }
    
    private function compileArguments ($token, $arguments) {
        list($subtoken, $subargs) = $arguments;
        
        if ($token === 'such' && $subtoken === 'much') {
            return ' ('
                . implode(', ', $subargs[0])
                . ') {';
        }
        
        if ($subtoken === 'is') {
            return '= ' . $this->compileToken($subargs[0], $subargs[1]);
        }
        
        if ($token === 'plz' && $subtoken === 'with') {
            return implode(', ', $subargs);
        }
        
        return '';
    }
    
}