<?php namespace Doge;

/**
 * Lexer class
 * 
 * Separates flat list of tokens into statements and sub expressions
 * 
 * @package dogescript-php
 */
class Lexer extends Base {
    
    /**
     * Process tokens into array statements
     * 
     * @param array $tokens
     * @return array
     */
    public function analyze ($tokens) {
        $statements = $this->separateStatements($tokens);
        $statements = $this->processComments($statements);
        $statements = $this->joinNonKeywords($statements);
        
        return $this->separateCompoundExpressions($statements);
    }
    
    /**
     * Separate flat list of tokens into array of statements
     * 
     * @param array $tokens
     * @return array
     */
    private function separateStatements ($tokens) {
        $output = [];
        $line   = [];
        
        foreach ($tokens as $index => $token) {
            $isNewline = $token === "\n";
            $isLast    = $index === count($tokens) - 1;
            
            if (!$isNewline || $isLast) {
                $line[] = $token;
            }
            
            if ($isNewline || $isLast) {
                $output[] = $line;
                
                $line = [];
            }
        }
        
        return $output;
    }
    
    /**
     * Process comments
     * 
     * Merge all tokens after `shh` in one line comments into one token
     * 
     * Merge every line into one token after `quiet` and before `loud` multi-
     * line comments
     * 
     * @param array $statements
     * @return array
     */
    private function processComments ($statements) {
        $comment = false;
        
        foreach ($statements as $i => $line) {
            if (empty($line)) {
                continue;
            }
            
            list($first) = $line;
            
            $statements[$i] = $this->processOnelinerComment($first, $line);
            
            /* Dealing with multi-line comments */
            if ($first === 'quiet') {
                $comment = true;
            }
            else if ($first === 'loud') {
                $comment = false;
            }
            else if ($comment) {
                $statements[$i] = [implode(' ', $line)];
            }
        }
        
        return $statements;
    }
    
    /**
     * Process one line comment
     * 
     * @param string $first
     * @param array $line
     * @return array
     */
    private function processOnelinerComment ($first, $line) {
        $tail = implode(' ', array_slice($line, 1));
        
        return $first === 'shh' ? [$first, $tail] : $line;
    }
    
    /**
     * Join non keywords tokens
     * 
     * Basically, I wrote some magic shit which I can't explain.
     *
     * I hope you're smart enought to figure out it yourself.
     * 
     * Maybe, some day, I'll rewrite it into simpler shit.
     * 
     * @param array $statements
     * @return array
     */
    private function joinNonKeywords ($statements) {
        $buffer = new TokenBuffer($this->grammar);
        
        foreach ($statements as $i => $line) {
            $statements[$i] = $this->joinNonKeywordLine($line, $buffer);
        }
        
        return $statements;
    }
    
    /**
     * Join non keyword line
     * 
     * @param array $line
     * @param \Doge\TokenBuffer $buffer
     * @return array
     */
    private function joinNonKeywordLine ($line, $buffer) {
        $new_line = [];
        
        foreach ($line as $token) {
            if ($this->isKeyword($token)) {
                $new_line[] = $token;
            }
            else {
                $buffer->append($token);
            }
            
            if (!$buffer->isEmpty() && $buffer->isFinished()) {
                $new_line[] = $buffer->toString(true);
            }
        }
        
        if (!$buffer->isEmpty()) {
            $new_line[] = $buffer->toString(true);
        }
        
        return $new_line;
    }
    
    /**
     * Separate compound expressions
     * 
     * Everything inside of parantheses is counting as separate expression 
     * which will be placed into separate nested list (e.g. array).
     * 
     * @todo implement recursive search
     * @param array $statements
     * @return array
     */
    private function separateCompoundExpressions ($statements) {
        foreach ($statements as $i => $line) {
            $statements[$i] = $this->processSeparateExpression($line);
        }
        
        return $statements;
    }
    
    private function processSeparateExpression ($line) {
        $buffer = [];
        $new_line = [];
        $open = false;
        
        foreach ($line as $token) {
            if (strpos($token, '(') === 0) {
                $open = true;
            }
            else if (
                $open &&
                strpos($token, ')') === strlen($token) - 1 && 
                !empty($buffer)
            ) {
                $buffer[] = trim($token, '()');
                $new_line[] = $buffer;
                $buffer = [];
                
                $open = false;
                
                continue;
            }
            
            if ($open) {
                $buffer[] = trim($token, '()');
            }
            else {
                $new_line[] = $token;
            }
        }
        
        return $new_line;
    }
    
}