<?php namespace Doge;

/**
 * Compiler interface
 * 
 * @package dogescript-php
 */
interface LienCompiler extends Compiler {
    
    /**
     * @param array $line
     * @return bool
     */
    public function isMatches ($line);
    
}