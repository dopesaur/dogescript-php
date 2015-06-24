<?php namespace Doge;

/**
 * Compiler interface
 * 
 * @package dogescript-php
 */
interface Compiler {
    
    /**
     * @param array $grammar
     */
    public function __construct ($grammar);
    
    /**
     * @param array $tokens
     * @return string
     */
    public function compile ($tokens);
    
}