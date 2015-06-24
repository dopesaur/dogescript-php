<?php namespace Doge\Compilers;

use Doge\Base;
use Doge\Compiler;

/**
 * Compiler which compiles array of dogescript statements
 * into working PHP code.
 * 
 * Right now, it uses ugly if/else logic, but it's just for now
 * 
 * @package dogescript-php
 */
class PHP extends Base implements Compiler {
    
    /**
     * {@inheritdoc}
     */
    public function compile ($tokens) {
        $code = '';
        
        foreach ($tokens as $line) {
            $code .= (!empty($line) ? $this->compileLine($line) : '') . "\n";
        }
        
        return $code;
    }
    
    /**
     * Compiles statement into PHP code using ugly if/else logic
     * 
     * @param array $line
     * @return string
     */
    private function compileLine ($line) {
        foreach ($line as $i => $token) {
            if (is_array($token)) {
                $line[$i] = trim($this->compileLine($token), ';');
            }
        }
        
        $last   = current(array_slice($line, -1, 1)) ?: '';
        $first  = current(array_slice($line,  0, 1)) ?: '';
        $second = current(array_slice($line,  1, 1)) ?: '';
        
        $length = count($line);
        
        $code = '';
        
        if ($first === 'shh') {
            $code .= "// $second";
        }
        
        if ($first === 'quiet') {
            $code .= '/*' . ($second === 'dogeblock' ? '*' : '');
        }
        
        if ($first === 'loud') {
            $code .= '*/';
        }
        
        if ($first === 'very') {
            $last = implode(' ', array_slice($line, 3));
            
            $code .= "$second = $last;";
        }
        
        if ($second === 'is') {
            $last = implode(' ', array_slice($line, 2));
            
            $code .= "$first = $last;";
        }
        
        if ($first === 'so' && $length > 1) {
            $code .= "use $second";
            
            if ($length > 2) {
                $code .= " as $last";
            }
            
            $code .= ';';
        }
        
        if ($first === 'plz') {
            $arguments = '';
            
            if ($length > 2) {
                $arguments = implode(', ', array_slice($line, 3));
            }
            
            $code .= "$second($arguments);";
        }
        
        if ($first === 'but') {
            $code .= 'else ';
        }
        
        if ($first === 'rly' || $second === 'rly') {
            $index = $first === 'rly' ? 1 : 2;
            
            $code .= 'if (' 
                . $this->compileBoolean(implode(' ', array_slice($line, $index, -1))) 
                . ') ';
        }
        
        if ($first === 'notrly') {
            $code .= 'if (!(' 
                . $this->compileBoolean(implode(' ', array_slice($line, 1, -1))) 
                . ')) ';
        }
        
        if ($first === 'many') {
            $code .= 'while ('
                . $this->compileBoolean(implode(' ', array_slice($line, 1, -1)))
                . ') ';
        }
        
        if ($second === 'more') {
            $third = $line[2];
            $code .= "$first += $third;";
        }
        
        if ($first === '4lulz') {
            $with = array_search('with', $line);
            $arguments = array_slice($line, 1, $with - 1);
            
            $arguments = count($arguments) > 1 
                ? "{$arguments[0]} => {$arguments[1]}"
                : "{$arguments[0]}";
            
            $with = $line[$with + 1];
            
            $code .= "foreach ($with as $arguments) ";
        }
        
        if ($second === 'less') {
            $third = $line[2];
            $code .= "$first -= $third;";
        }
        
        if ($second === 'lots') {
            $third = $line[2];
            $code .= "$first *= $third;";
        }
        
        if ($second === 'few') {
            $third = $line[2];
            $code .= "$first /= $third;";
        }
        
        if ($first === 'such') {
            $arguments = '';
            
            if ($length > 2) {
                $arguments = implode(', ', array_slice($line, 3, -1));
            }
            
            $code .= "function $second ($arguments) ";
        }
        
        if ($last === 'so') {
            $code .= '{';
        }
        
        if ($first === 'wow') {
            if ($length > 1) {
                $code .= 'return ' . implode(' ', array_slice($line, 1)) . ";\n";
            }
            
            $code .= "}";
        }
        
        if ($code) {
            return $code;
        }
        
        return $length === 1 ? implode(' ', $line) : '';
    }
    
    /**
     * Compile expression
     * 
     * @param string $line
     * @return string
     */
    private function compileBoolean ($line) {
        static $tokens = null;
        
        $tokens or $tokens = [
            ' totally ' => ' === ',
            ' noway '   => ' !== ',
            'not '     => '!',
            ' is '      => ' == ',
            ' isnt '    => ' != ',
            ' as '      => ' = ',
            ' or '      => ' || ',
            ' and '     => ' && ',
            ' next'    => ' ;',
            ' bigger '  => ' > ',
            ' smaller ' => ' < ',
            ' biggerish '  => ' >= ',
            ' smallerish ' => ' <= '
        ];
        
        return str_replace(
            array_keys($tokens),
            array_values($tokens),
            $line
        );
    }
    
}