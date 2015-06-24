<?php

/*
Example #1: Fibonacci function,
See dogenacci.php for compiled result

@so int
@wow so int
*/

function dogenacci ($n) {
if ($n === 0 || $n === 1) {
return 1;
}
else {
$first = $n - 1;
$second = $n - 2;

return dogenacci($first) + dogenacci($second);
}
}

// so doge, such factorial, much math

echo(dogenacci(6));
