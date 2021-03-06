<?php

/*
 * This file is part of the syntaxhighlighter-bundle package.
 *
 * (c) 2017 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\SyntaxHighlighterBundle\Tests\API;

use WBW\Bundle\SyntaxHighlighterBundle\API\SyntaxHighlighterStrings;
use WBW\Bundle\SyntaxHighlighterBundle\Tests\AbstractTestCase;

/**
 * SyntaxHightlighter strings test.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Bundle\SyntaxHighlighterBundle\Tests\API
 */
class SyntaxHighlighterStringsTest extends AbstractTestCase {

    /**
     * Tests the __construct() method.
     *
     * @return void
     */
    public function testConstruct() {

        $obj = new SyntaxHighlighterStrings();

        $this->assertEquals("SyntaxHighlighter\n\n", $obj->getAlert());
        $this->assertEquals("Brush wasn't made for html-script option:", $obj->getBrushNotHtmlScript());
        $this->assertEquals("copy to clipboard", $obj->getCopyToClipboard());
        $this->assertEquals("The code is in your clipboard now", $obj->getCopyToClipboardConfirmation());
        $this->assertEquals("+ expand source", $obj->getExpandSource());
        $this->assertEquals("?", $obj->getHelp());
        $this->assertEquals("Can't find brush for:", $obj->getNoBrush());
        $this->assertEquals("print", $obj->getPrint());
        $this->assertEquals("view source", $obj->getViewSource());
    }
}
