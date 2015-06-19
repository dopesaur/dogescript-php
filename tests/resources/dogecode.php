<?php

/**
 * 0 -> Dogescript code
 * 1 -> Parser tokens
 * 2 -> Lexer processed tokens
 * 3 -> Output PHP code
 */
return [
    /* Variable assignment */
    [
        '$abc is 20',
        [['$abc', 'is', '20']],
        [['$abc', ['is', ['20']]]],
        '$abc = 20;'
    ],
    
    /* Function declaration */
    [
        'such test much $abc
    wow $abc - 10',
        [
            ['such', 'test', 'much', '$abc'],
            ['wow', '$abc', '-', '10']
        ],
        [
            [
                ['such', ['test']], 
                ['much', ['$abc']]
            ],
            [
                ['wow', ['$abc', '-', '10']]
            ]
        ],
        'function test ($abc) {return $abc - 10;}'
    ],
    
    /* PHP use statement */
    [
        'so \Doge\Parser',
        [['so', '\Doge\Parser']],
        [[['so', ['\Doge\Parser']]]],
        'use \Doge\Parser;'
    ],
    
    /* PHP use statement with alias */
    [
        'so \Doge\Parser as DogeParser',
        [['so', '\Doge\Parser', 'as', 'DogeParser']],
        [[
            ['so', ['\Doge\Parser']],
            ['as', ['DogeParser']]
        ]],
        'use \Doge\Parser as DogeParser;'
    ],
    
    /* Function call */
    [
        'plz strpos with "doge" "do"',
        [['plz', 'strpos', 'with', '"doge"', '"do"']],
        [[
            ['plz', ['strpos']],
            ['with', ['"doge"', '"do"']],
        ]],
        'strpos("doge", "do");'
    ],
    
    /* Assign function result to variable */
    [
        '$pos is plz strpos with "doge" "do"',
        [['$pos', 'is', 'plz', 'strpos', 'with', '"doge"', '"do"']],
        [[
            '$pos',
            ['is', []],
            ['plz', ['strpos']],
            ['with', ['"doge"', '"do"']],
        ]],
        '$pos = strpos("doge", "do");'
    ],
    
    /* Comments */
    [
        'shh This is a comment',
        [
            ['shh', 'This', 'is', 'a', 'comment']
        ],
        [[
            ['shh', ['This', 'is', 'a', 'comment']]
        ]],
        '// This is a comment'
    ]
];