<?php

require __DIR__ . '/Delta.php';

$delta = new Delta;

function test_assert($a, $b, string $message)
{
	if ($a !== $b) {
		echo "Test FAIL: $message\n";
		echo "- " . $a . "\n";
		echo "+ " . $b . "\n";

		throw new \RuntimeException($message);
	}

	echo '.';
}

$orig = file_get_contents(__DIR__ . '/testdata/small.orig');
$target = file_get_contents(__DIR__ . '/testdata/small.target');
$d = file_get_contents(__DIR__ . '/testdata/small.delta');

test_assert($d, $delta->create($orig, $target), 'small: delta created differs from reference sample');
test_assert($target, $delta->apply($orig, $d), 'small: target created from delta differs from target sample file');

$orig = file_get_contents(__DIR__ . '/testdata/code.orig');
$target = file_get_contents(__DIR__ . '/testdata/code.target');
$d = file_get_contents(__DIR__ . '/testdata/code.delta');

test_assert($d, $delta->create($orig, $target), 'code: delta created differs from reference sample');
test_assert($target, $delta->apply($orig, $d), 'code: target created from delta differs from target sample file');

$orig = file_get_contents(__DIR__ . '/testdata/binary.orig');
$target = file_get_contents(__DIR__ . '/testdata/binary.target');
$d = file_get_contents(__DIR__ . '/testdata/binary.delta');

test_assert($d, $delta->create($orig, $target), 'binary: delta created differs from reference sample');
test_assert($target, $delta->apply($orig, $d), 'binary: target created from delta differs from target sample file');

// From https://github.com/vitalije/fossil-delta/blob/master/fossil-delta/src/lib.rs
$orig = file_get_contents(__DIR__ . '/testdata/rust1.orig');
$target = file_get_contents(__DIR__ . '/testdata/rust1.target');
$d = file_get_contents(__DIR__ . '/testdata/rust1.delta');

test_assert($d, $delta->create($orig, $target), 'rust1: delta created differs from reference sample');
test_assert($target, $delta->apply($orig, $d), 'rust1: target created from delta differs from target sample file');

$orig = file_get_contents(__DIR__ . '/testdata/rust2.orig');
$target = file_get_contents(__DIR__ . '/testdata/rust2.target');
$d = file_get_contents(__DIR__ . '/testdata/rust2.delta');

test_assert($d, $delta->create($orig, $target), 'rust2: delta created differs from reference sample');
test_assert($target, $delta->apply($orig, $d), 'rust2: target created from delta differs from target sample file');

echo " Success\n";