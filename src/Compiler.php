<?php namespace Doge;

interface Compiler {
    
    public function __construct ($grammar);
    public function compile ($tokens);
    
}