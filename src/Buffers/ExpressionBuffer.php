<?php namespace Doge\Buffers;

use Doge\Buffer;

/**
 * Expression buffer
 * 
 * Its job is to determine if nested expressions are complete 
 * (basically dogescript which in paranthesis)
 * 
 * @package dogescript-php
 */
class ExpressionBuffer extends Buffer {
    
    /**
     * @return bool
     */
    public function isComplete () {
        $count = $this->getCount($this->data);
        
        return $count[0] === $count[1];
    }
    
    /**
     * @param array $tokens
     * @return array
     */
    private function getCount ($tokens) {
        $count = [0, 0];
        
        foreach ($tokens as $token) {
            $tmp = is_array($token) 
                ? $this->getCount($token)
                : $this->countParanthesis($token);
            
            $count[0] += $tmp[0];
            $count[1] += $tmp[1];
        }
        
        return $count;
    }
    
    /**
     * @param string $string
     * @return array
     */
    private function countParanthesis ($string) {
        return [
            substr_count($string, '('),
            substr_count($string, ')')
        ];
    }
    
}