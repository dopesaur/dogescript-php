<?php

/**
 * This is data provider for following tests:
 * 
 * - LexerTest
 * - ParserTest
 * - Compiler test
 * 
 * Each of this indices correspondes with following list:
 * 
 * - 0 => Dogescript code
 * - 1 => Parser tokens
 * - 2 => Lexer processed tokens
 * - 3 => Output PHP code
 */
return [
    /**
     * Comments testing
     * 
     * - shh comment
     * - quiet loud comment
     * - dogeblock comment
     */
    [
        'shh This is dogescript comment',
        ['shh', 'This', 'is', 'dogescript', 'comment'],
        [
            ['shh', 'This is dogescript comment']
        ],
        '// This is dogescript comment'
    ],

    [
        'quiet
            Cool comment is here
        loud',
        ['quiet', "\n", 'Cool', 'comment', 'is', 'here', "\n", 'loud'],
        [
            ['quiet'], 
            ['Cool comment is here'], 
            ['loud']
        ],
        '/*
Cool comment is here
*/'
    ],
    [
        'quiet dogeblock
            so string
            very int
            such callable
            wow so string
        loud',
        [
            'quiet', 'dogeblock', "\n", 
            'so', 'string', "\n", 
            'very', 'int' , "\n", 
            'such', 'callable', "\n", 
            'wow', 'so', 'string', "\n", 
            'loud',
        ],
        [
            ['quiet', 'dogeblock'], 
            ['so string'], 
            ['very int'], 
            ['such callable'], 
            ['wow so string'], 
            ['loud']
        ],
        '/**
so string
very int
such callable
wow so string
*/'
    ],
    
    /**
     * Control flow structures tests:
     * 
     * - if (rly)
     * - unless (notrly)
     * - else if (but rly)
     * - else (but)
     * - much (while)
     * - many (for)
     * - 4lulz (foreach)
     */
    [
        'rly $sum totally 42 so
            wow true',
        [
            'rly', '$sum', 'totally', '42', 'so', "\n",
            'wow', 'true',
        ],
        [
            ['rly', '$sum', 'totally', '42', 'so'],
            ['wow', 'true']
        ],
        'if ($sum === 42) {
return true;
}'
    ],
    [
        'rly $i totally 1 or $i totally 0 so
            wow 1',
        [
            'rly', '$i', 'totally', '1', 'or', '$i', 'totally', '0', 'so', "\n",
            'wow', '1'
        ],
        [
            ['rly', '$i', 'totally', '1', 'or', '$i', 'totally', '0', 'so'],
            ['wow', '1']
        ],
        'if ($i === 1 || $i === 0) {
return 1;
}'
    ],
    [
        'notrly $sum noway 42 so
            wow false',
        [
            'notrly', '$sum', 'noway', '42', 'so', "\n",
            'wow', 'false',
        ],
        [
            ['notrly', '$sum', 'noway', '42', 'so'],
            ['wow', 'false']
        ],
        'if (!($sum !== 42)) {
return false;
}'
    ],
    [
        'rly $sum totally 42 so
            wow true
        but rly is_int($sum) so
            wow []',
        [
            'rly', '$sum', 'totally', '42', 'so', "\n",
            'wow', 'true', "\n",
            'but', 'rly', 'is_int($sum)', 'so', "\n",
            'wow', '[]',
        ],
        [
            ['rly', '$sum', 'totally', '42', 'so'],
            ['wow', 'true'],
            ['but', 'rly', 'is_int($sum)', 'so'],
            ['wow', '[]']
        ],
        'if ($sum === 42) {
return true;
}
else if (is_int($sum)) {
return [];
}'
    ],
    [
        'rly $sum totally 42 so
            wow true
        but so
            plz print with "fuck"
        wow',
        [
            'rly', '$sum', 'totally', '42', 'so', "\n",
            'wow', 'true', "\n",
            'but', 'so', "\n",
            'plz', 'print', 'with', '"fuck"', "\n",
            'wow'
        ],
        [
            ['rly', '$sum', 'totally', '42', 'so'],
            ['wow', 'true'],
            ['but', 'so'],
            ['plz', 'print', 'with', '"fuck"'],
            ['wow']
        ],
        'if ($sum === 42) {
return true;
}
else {
print("fuck");
}'
    ],
    [
        'many not $i so
            plz print with "weee!"
            
            $i more 1
        wow',
        [
            'many', 'not', '$i', 'so', "\n",
            'plz', 'print', 'with', '"weee!"', "\n",
            "\n",
            '$i', 'more', '1', "\n",
            'wow'
        ],
        [
            ['many', 'not', '$i', 'so'],
            ['plz', 'print', 'with', '"weee!"'],
            [],
            ['$i', 'more', '1'],
            ['wow']
        ],
        'while (!$i) {
print("weee!");

$i += 1;
}'
    ],
    [
        'much very $i as 1 next $i smaller 10 next $i more 1 so
            rly $i bigger 2 so
                shh Do something
            wow
        wow',
        [
            'much', 'very', '$i', 'as', '1', 'next', '$i', 'smaller', '10', 'next', '$i', 'more', '1', 'so', "\n",
            'rly', '$i', 'bigger', '2', 'so', "\n",
            'shh', 'Do', 'something', "\n",
            'wow', "\n",
            'wow'
        ],
        [
            ['much', 'very', '$i', 'as', '1', 'next', '$i', 'smaller', '10', 'next', '$i', 'more', '1', 'so'],
            ['rly', '$i', 'bigger', '2', 'so'],
            ['shh', 'Do something'],
            ['wow'],
            ['wow']
        ],
        'for ($i = 1; $i < 10; $i += 1) {
if ($i > 2) {
// Do something
}
}'
    ],
    [
        '4lulz $doge with $dogs so
            plz echo with $doge
        wow',
        [
            '4lulz', '$doge', 'with', '$dogs', 'so', "\n",
            'plz', 'echo', 'with', '$doge', "\n",
            'wow'
        ],
        [
            ['4lulz', '$doge', 'with', '$dogs', 'so'],
            ['plz', 'echo', 'with', '$doge'],
            ['wow']
        ],
        'foreach ($dogs as $doge) {
echo($doge);
}'
    ],
    [
        '4lulz $doge $value with $dogs so
            plz echo with $doge
        wow',
        [
            '4lulz', '$doge', '$value', 'with', '$dogs', 'so', "\n",
            'plz', 'echo', 'with', '$doge', "\n",
            'wow'
        ],
        [
            ['4lulz', '$doge', '$value', 'with', '$dogs', 'so'],
            ['plz', 'echo', 'with', '$doge'],
            ['wow']
        ],
        'foreach ($dogs as $doge => $value) {
echo($doge);
}'
    ],
    
    /**
     * Functions:
     * 
     * - function declaration (such, such much)
     * - function call (plz, plz with)
     * - nested function call (nested expressions)
     */
    [
        'such test so
            shh so true
            wow true',
        [
            'such', 'test', 'so', "\n",
            'shh', 'so', 'true', "\n",
            'wow', 'true',
        ],
        [
            ['such', 'test', 'so'],
            ['shh', 'so true'],
            ['wow', 'true'],
        ],
        'function test () {
// so true
return true;
}'
    ],
    [
        'such test much $parameters so
            wow compact("parameters")',
        [
            'such', 'test', 'much', '$parameters', 'so', "\n",
            'wow', 'compact("parameters")',
        ],
        [
            ['such', 'test', 'much', '$parameters', 'so'],
            ['wow', 'compact("parameters")'],
        ],
        'function test ($parameters) {
return compact("parameters");
}'
    ],
    [
        'such test much $a $b so
            wow $a + $b',
        [
            'such', 'test', 'much', '$a', '$b', 'so', "\n",
            'wow', '$a', '+', '$b',
        ],
        [
            ['such', 'test', 'much', '$a', '$b', 'so'],
            ['wow', '$a', '+', '$b'],
        ],
        'function test ($a, $b) {
return $a + $b;
}'
    ],
    [
        'such test much $a $b so
            amaze $a + $b
        wow',
        [
            'such', 'test', 'much', '$a', '$b', 'so', "\n",
            'amaze', '$a', '+', '$b', "\n",
            'wow'
        ],
        [
            ['such', 'test', 'much', '$a', '$b', 'so'],
            ['amaze', '$a', '+', '$b'],
            ['wow']
        ],
        'function test ($a, $b) {
return $a + $b;
}'
    ],
    [
        'plz test',
        ['plz', 'test'],
        [['plz', 'test']],
        'test();'
    ],
    [
        'plz test with [1, 2, 3]',
        ['plz', 'test', 'with', '[1,', '2,', '3]'],
        [['plz', 'test', 'with', '[1, 2, 3]']],
        'test([1, 2, 3]);'
    ],
    [
        'shh This is doge script
        
        very $doge is "so awesome"
        
        rly $doge is "so awesome" so
            plz print with "so doge"
        wow
        
        plz print with "cool doge"',
        [
            'shh', 'This', 'is', 'doge', 'script', "\n",
            "\n",
            'very', '$doge', 'is', '"so', 'awesome"', "\n",
            "\n",
            'rly', '$doge', 'is', '"so', 'awesome"', 'so', "\n",
            'plz', 'print', 'with', '"so', 'doge"', "\n",
            'wow', "\n",
            "\n",
            'plz', 'print', 'with', '"cool', 'doge"'
        ],
        [
            ['shh', 'This is doge script'],
            [],
            ['very', '$doge', 'is', '"so awesome"'],
            [],
            ['rly', '$doge', 'is', '"so awesome"', 'so'],
            ['plz', 'print', 'with', '"so doge"'],
            ['wow'],
            [],
            ['plz', 'print', 'with', '"cool doge"']
        ],
        '// This is doge script

$doge = "so awesome";

if ($doge == "so awesome") {
print("so doge");
}

print("cool doge");'
    ],
    [
        'plz test with 10 20 30',
        ['plz', 'test', 'with', '10', '20', '30'],
        [['plz', 'test', 'with', '10', '20', '30']],
        'test(10, 20, 30);'
    ],
    [
        'shh Compound expressions
        
        very $doge is (plz test with 10 20 30)',
        [
            'shh', 'Compound', 'expressions', "\n", 
            "\n",
            'very', '$doge', 'is', '(plz', 'test', 'with', '10', '20', '30)'
        ],
        [
            ['shh', 'Compound expressions'],
            [],
            ['very', '$doge', 'is', ['plz', 'test', 'with', '10', '20', '30']]
        ],
        '// Compound expressions

$doge = test(10, 20, 30);'
    ],
    [
        'shh Compound nested expressions
        
        very $doge is (plz test with 10 (plz strpos with "doge" "do") 30)',
        [
            'shh', 'Compound', 'nested', 'expressions', "\n", 
            "\n",
            'very', '$doge', 'is', '(plz', 'test', 'with', '10', '(plz', 'strpos', 'with', '"doge"', '"do")', '30)'
        ],
        [
            ['shh', 'Compound nested expressions'], 
            [],
            [
                'very', '$doge', 'is', 
                [
                    'plz', 'test', 'with', '10', 
                    ['plz', 'strpos', 'with', '"doge"', '"do"'], 
                    '30'
                ]
            ]
        ],
        '// Compound nested expressions

$doge = test(10, strpos("doge", "do"), 30);'
    ],
    
    /**
     * Miscellaneous:
     * 
     * - variable assignment
     * - importing class (use statement)
     */
    [
        'very $doge is "so doge"',
        ['very', '$doge', 'is', '"so', 'doge"'],
        [['very', '$doge', 'is', '"so doge"']],
        '$doge = "so doge";'
    ],
    [
        '$doge is "indie levl 99"',
        ['$doge', 'is', '"indie', 'levl', '99"'],
        [['$doge', 'is', '"indie levl 99"']],
        '$doge = "indie levl 99";'
    ],
    [
        'so Doge\Parser',
        ['so', 'Doge\Parser'],
        [['so', 'Doge\Parser']],
        'use Doge\Parser;'
    ],
    [
        'so Doge\Parser as DogeFriend',
        ['so', 'Doge\Parser', 'as', 'DogeFriend'],
        [['so', 'Doge\Parser', 'as', 'DogeFriend']],
        'use Doge\Parser as DogeFriend;'
    ],
];