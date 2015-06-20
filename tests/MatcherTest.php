<?php

use Doge\Matcher;

class MatcherTest extends PHPUnit_Framework_TestCase {
    
    public function createMatcher () {
        return new Matcher(require dirname(__DIR__) . '/keywords.php');
    }
    
    public function tokenProvider () {
        return require __DIR__ . '/resources/matcher.php';
    }
    
    /**
     * @dataProvider tokenProvider
     */
    public function testMatcher ($tokens, $statement) {
        $matcher = $this->createMatcher();
        $result  = $matcher->match($tokens);
        
        $this->assertEquals($statement, $result);
    }
    
    /**
     * @dataProvider tokenProvider
     */
    public function testMatchingTokens ($tokens, $_, $output) {
        $matcher = $this->createMatcher();
        $result  = $matcher->matchTokens($tokens);
        
        var_dump($output, $result);
        
        $this->assertEquals($output, $result);
    }
    
}