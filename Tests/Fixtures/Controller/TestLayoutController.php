<?php

/**
 * This file is part of the syntaxhighlighter-bundle package.
 *
 * (c) 2018 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\SyntaxHighlighterBundle\Tests\Fixtures\Controller;

use WBW\Bundle\CoreBundle\Controller\AbstractController;

/**
 * Test layout controller.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Bundle\SyntaxHighlighterBundle\Tests\Fixtures\Controller
 */
class TestLayoutController extends AbstractController {

    /**
     * Displays a javascripts template.
     *
     * @return Response Returns the response.
     */
    public function javascriptsAction() {

        // Return the response.
        return $this->render("@SyntaxHighlighter/layout/javascripts.html.twig");
    }

    /**
     * Displays a stylesheets template.
     *
     * @return Response Returns the response.
     */
    public function stylesheetsAction() {

        // Return the response.
        return $this->render("@SyntaxHighlighter/layout/stylesheets.html.twig");
    }

}
