<?php 
// This is dogescript-php
include("test.dphp");
function test ($a, $b, $c) {
return $a + $b + $c;}
$sum = test(10, 20, 30);
print("$sum\n");