<?php
/**
 * This file is part of the syntaxhighlighter-bundle package.
 *
 * (c) 2017 NdC/WBW
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (file_exists($file = __DIR__ . "/autoload.php")) {
	require_once $file;
} elseif (file_exists($file = __DIR__ . "/autoload.php.dist")) {
	require_once $file;
}
