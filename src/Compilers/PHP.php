<?php namespace Doge\Compilers;

use Doge\Base;
use Doge\Compiler;

class PHP extends Base implements Compiler {
    
    public function compile ($tokens) {
        $code = '';
        
        foreach ($tokens as $line) {
            $code .= $this->compileLine($line) . "\n";
        }
        
        return trim($code);
    }
    
    private function compileLine ($line) {
        $code = '';
        
        foreach ($line as $index => $token) {
            if (is_array($token)) {
                $code .= $this->compileToken($token, $index, $line);
            }
            else {
                $code .= "$token ";
            }
        }
        
        return $code;
    }
    
    private function compileToken ($token, $index, $line) {
        $code = '';
        $lastToken = $index + 1 === count($line);
        
        list($token, $arguments) = $token;
        
        if ($token === 'shh') {
            $code .= '// ' . implode(' ', $arguments);
        }
        
        if ($token === 'is') {
            $code .= '= ';
            
            if (!empty($arguments)) {
                $code .= current($arguments) . ';';
            }
        }
        
        if ($token === 'such') { 
            $code .= 'function ' . current($arguments); 
        }
        
        if ($token === 'much') { 
            $code .= ' (' . implode(', ', $arguments) . ') {'; 
        }
        
        if ($token === 'wow' && $lastToken)  { 
            $code .= 'return ' . implode(' ', $arguments) . ';}'; 
        }
        else if ($token === 'wow') {
            $code .= '}';
        }
        
        if ($token === 'so') { 
            $code .= 'use ' . current($arguments) . ($lastToken ? ';' : '');
        }
         
        if ($token === 'as') {
            $code .= ' as ' . current($arguments) . ';';
        }
        
        if ($token === 'plz') {
            $code .= current($arguments) . '(';
        }
        
        if ($token === 'with') {
            $code .= implode(', ', $arguments) . ');';
        }
        
        return $code;
    }
    
}