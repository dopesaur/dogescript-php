<?php namespace Doge;

use Doge\Captures\All;
use Doge\Captures\TillToken;
use Doge\Captures\One;

class Matcher {
    use Base {
        __construct as constructor;
    }
    
    private $captures;
    
    public function __construct ($grammar) {
        $this->constructor($grammar);
        
        $this->captures = [
            '*'   => new All,
            '*->' => new TillToken,
            '$'   => new One
        ];
    }
    
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
            if ($statement = $this->matchStatement($tokens, $string)) {
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
        $result    = [];
        
        foreach ($fragments as $index => $fragment) {
            $token = current($tokens);
            $next  = isset($fragments[$index + 1]) ? $fragments[$index + 1] : null;
            
            if ($fragment === $token) {
                $result[] = [array_shift($tokens)];
            }
            else if (isset($this->captures[$fragment])) {
                $capture = $this->captures[$fragment];
                $capture = $capture->capture($tokens, $next);
                
                $tokens = array_slice($tokens, count($capture));
                $result[] = $capture;
            }
        }
        
        $correlates = count($fragments) === count($result) && empty($tokens);
        
        return $correlates ? $this->formatOutput($result) : [];
    }
    
    private function formatOutput ($tokens) {
        $length = count($tokens);
        $result = [];
        
        for ($i = $length - 1; $i >= 0; $i --) {
            $array = $tokens[$i];
            $last  = $i === $length - 1;
            
            if ($last) {
                $result = $array;
            }
            else {
                $result = array_merge($array, [$result]);
            }
        }
        
        return $result;
    }
    
}