<?php

/*
Example #1: Fibonacci function,
See dogenacci.php for compiled result

@so int
@wow so int
*/

function dogenacci ($n) {
if ($n === 0 && $n === 1) {
return 1;
}
else {
return dogenacci($n-1) + dogenacci($n-2);
}
}

echo(dogenacci(5));
