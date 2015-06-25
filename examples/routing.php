<?php

/*
Example #3: Simple dogerouter

All it's doing is transforming route into
3 element array
*/

/**
@so string $route
@wow so array
*/

function router ($route) {
$fragments = explode('/', $route);

$controller = array_shift($fragments);
$action = array_shift($fragments);

return [$controller, $action, $fragments];
}

var_dump(router('abc/def/ghi'));
