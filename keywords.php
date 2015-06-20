<?php

/**
 * Dogescript language file
 */

return [
    /**
     * List of statements
     * 
     * Special flags used:
     * "*"   - everything before end of statement (expression(s))
     * "*->" - everything before keyword specified after token
     * "$"   - one token
     */
    'statements' => [
        /* Comments */
        'shh *',
        'quiet *-> loud',
        'quiet dogeblock *-> loud',
        
        /* Control flow structures */
        'rly *',
        'notrly *',
        'but rly *',
        'but',
        'many *',
        'much *',
        
        /* Functions */
        'such $ much *',
        'plz $',
        'plz $ with *',
        'wow',
        'wow *',
        
        /* Basics */
        'very $ is *',
        '$ is *',
        'so $',
        'so $ as $',
    ],
    
    /**
     * Dogescript keywords, some JS specific keywords were thrown away 
     * (i.e. trained and very)
     * 
     * @link https://github.com/dogescript/dogescript/blob/master/LANGUAGE.md
     */
    'keywords' => [
        /* Comments */
        'shh',
        'quiet',
        'loud',
        'dogeblock',
        
        /* Functions */
        'such',
        'wow',
        'plz',
        'with',
        
        /* Control structures */
        'rly',
        'but',
        'notrly',
        'many',
        'much',
        
        /* Basics */
        'dose',
        'maybe',
        'so',
        
        /* Comparison and logic */
        // 'is',
        'totally',
        'not',
        'noway',
        'and',
        'or',
        'as',
        'bigger',
        'smaller',
        'biggerish',
        'smallerish',
        
        /* Assignment */
        'is',
        'more',
        'less',
        'lots',
        'few',
    ]
];