<?php

function router ($route) {
$frags = explode('/', $route);

$controller = array_shift($frags);
$action = array_shift($frags);
$fragments = $frags;

var_dump(compact('controller', 'action', 'fragments'));
}

router('abc/def/ghij');
