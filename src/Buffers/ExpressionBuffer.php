<?php namespace Doge\Buffers;

use Doge\Buffer;

class ExpressionBuffer extends Buffer {
    
    public function isComplete () {
        $count = $this->getCount($this->data);
        
        return $count[0] === $count[1];
    }
    
    private function getCount ($tokens) {
        $count = [0, 0];
        
        foreach ($tokens as $token) {
            if (is_array($token)) {
                $tmp = $this->getCount($token);
            }
            else {
                $tmp = $this->countParanthesis($token);
            }
            
            list($first, $second) = $tmp;
            
            $count[0] += $first;
            $count[1] += $second;
        }
        
        return $count;
    }
    
    private function countParanthesis ($string) {
        return [
            substr_count($string, '('),
            substr_count($string, ')')
        ];
    }
    
}