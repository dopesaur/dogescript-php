<?php namespace Doge;

class Lexer extends Base {
    
    public function analyze ($tokens) {
        $statements = $this->separateStatements($tokens);
        $statements = $this->processComments($statements);
        $statements = $this->joinNonKeywords($statements);
        
        return $this->separateCompoundExpressions($statements);
    }
    
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
                $output[] = array_splice($line, 0, count($line));
            }
        }
        
        return $output;
    }
    
    private function processComments ($statements) {
        $comment = false;
        
        foreach ($statements as $i => $line) {
            if (empty($line)) {
                continue;
            }
            
            list($first) = $line;
            
            if ($first === 'shh') {
                $tail = implode(' ', array_slice($line, 1));
                
                $statements[$i] = [$first, $tail];
            }
            
            if ($first === 'quiet') {
                $comment = true;
            }
            else if ($first === 'loud') {
                $comment = false;
            }
            
            if ($comment && $first !== 'quiet') {
                $statements[$i] = [implode(' ', $line)];
            }
        }
        
        return $statements;
    }
    
    private function joinNonKeywords ($statements) {
        $buffer = new TokenBuffer($this->grammar);
        
        foreach ($statements as $i => $line) {
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
            
            $statements[$i] = $new_line;
        }
        
        return $statements;
    }
    
    private function separateCompoundExpressions ($statements) {
        $buffer = [];
        $open = false;
        
        foreach ($statements as $i => $line) {
            $new_line = [];
            
            foreach ($line as $token) {
                if (strpos($token, '(') === 0) {
                    $open = true;
                }
                else if (
                    strpos($token, ')') === strlen($token) - 1 && 
                    !empty($buffer)
                ) {
                    $buffer[] = trim($token, '()');
                    $new_line[] = $buffer;
                    $buffer = [];
                    
                    $open = false;
                    
                    continue;
                }
                
                if (!$open) {
                    $new_line[] = $token;
                }
                
                if ($open) {
                    $buffer[] = trim($token, '()');
                }
            }
            
            $statements[$i] = $new_line;
        }
        
        return $statements;
    }
    
}