<?php namespace Doge;

class Matcher extends Base {
    
    public function match ($tokens) {
        $result = false;
        
        foreach ($this->grammar['statements'] as $string) {
            $statement = $this->matchStatement($tokens, $string);
            
            if ($statement) {
                $result = $string;
                
                break;
            }
        }
        
        return $result;
    }
    
    public function matchTokens ($tokens) {
        foreach ($this->grammar['statements'] as $string) {
            $statement = $this->matchStatement($tokens, $string);
            
            if ($statement) {
                return $statement;
            }
        }
        
        return [];
    }
    
    /**
     * @todo decompose on capturers
     */
    private function matchStatement ($tokens, $statement) {
        $fragments = explode(' ', $statement);
        $original  = $tokens;
        
        $result = [];
        $line   = [];
        
        foreach ($fragments as $index => $fragment) {
            $token = array_shift($tokens);
            
            if (
                $fragment === $token ||
                $fragment === '$'
            ) {
                $result[] = [$token];
            }
            else if ($fragment === '*') {
                $line[] = $token;
                
                while (!empty($tokens)) {
                    $line[] = array_shift($tokens);
                }
                
                $result[] = $line;
                $line = [];
            }
            else if ($fragment === '*->') {
                $next_fragment = $fragments[$index + 1];
                $next_token    = current($tokens);
                
                $line[] = $token;
                
                while ($next_fragment !== $next_token && !empty($tokens)) {
                    $token = array_shift($tokens);
                    $next_token = current($tokens);
                    
                    $line[] = $token;
                }
                
                $result[] = $line;
                $line = [];
            }
        }
        
        if (count($fragments) === count($result) && empty($tokens)) {
            return $this->formatOutput($result, $statement);
        }
        else {
            return [];
        }
    }
    
    private function formatOutput ($tokens, $statement) {
        if ($statement === '$ is $') {
            list($first, $second, $third) = $tokens;
            
            $tokens[0] = $second;
            $tokens[1] = [current($first), current($third)];
            
            unset($tokens[2]);
        }
        
        $result = [];
        $length = count($tokens);
        $i = $length - 1;
        
        while ($i >= 0) {
            $array = $tokens[$i];
            $last  = $i-- === $length - 1;
            
            $result = $last ? $array : array_merge($array, [$result]);
        }
        
        return $result;
    }
    
}