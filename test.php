<?php

require __DIR__ . '/Delta.php';

$delta = new Delta;

function test_assert(bool $test, string $message)
{
	if (!$test) {
		throw new \RuntimeException($message);
	}
}

$orig = file_get_contents(__DIR__ . '/testdata/small.orig');
$target = file_get_contents(__DIR__ . '/testdata/small.target');
$d = file_get_contents(__DIR__ . '/testdata/small.delta');

test_assert($d == $delta->create($orig, $target), 'small: delta created differs from reference sample');
test_assert($target == $delta->apply($orig, $d), 'small: target created from delta differs from target sample file');

$orig = file_get_contents(__DIR__ . '/testdata/code.orig');
$target = file_get_contents(__DIR__ . '/testdata/code.target');
$d = file_get_contents(__DIR__ . '/testdata/code.delta');

test_assert($d == $delta->create($orig, $target), 'code: delta created differs from reference sample');
test_assert($target == $delta->apply($orig, $d), 'code: target created from delta differs from target sample file');

$orig = file_get_contents(__DIR__ . '/testdata/binary.orig');
$target = file_get_contents(__DIR__ . '/testdata/binary.target');
$d = file_get_contents(__DIR__ . '/testdata/binary.delta');

test_assert($d == $delta->create($orig, $target), 'binary: delta created differs from reference sample');
test_assert($target == $delta->apply($orig, $d), 'binary: target created from delta differs from target sample file');

echo "Success\n";