<?php

/**
 * 0 -> Statement tokens
 * 1 -> Matching statement definition 
 */
return [
    [
        ['plz', 'echo'],
        'plz $',
        ['plz', ['echo']]
    ],
    [
        ['$abc', 'is', '"123"'],
        '$ is $',
        ['is', ['$abc', '"123"']]
    ],
    [
        ['plz', 'echo', 'with', '"cool string"'],
        'plz $ with *',
        ['plz', ['echo', ['with', ['"cool string"']]]]
    ],
    [
        ['shh', 'This', 'is', 'code', 'comment'],
        'shh *',
        ['shh', ['This', 'is', 'code', 'comment']]
    ],
    [
        [
            'quiet', 
            'This is a code comment, but the difference ', 
            'it is a little bit longer and also it\'s multi-line',
            'suck it!', 
            'loud'
        ],
        'quiet *-> loud',        
        [
            'quiet',
            [
                'This is a code comment, but the difference ', 
                'it is a little bit longer and also it\'s multi-line', 
                'suck it!',
                ['loud']
            ]
        ], 
    ],
    [
        [
            'rly',
            '$alley->cat',
            'totally',
            '"doge food"'
        ],
        'rly *',
        ['rly', ['$alley->cat', 'totally', '"doge food"']]
    ],
    [
        [
            'such',
            'test',
            'much',
            '$cool'
        ],
        'such $ much *',
        ['such', ['test', ['much', ['$cool']]]]
    ]
];