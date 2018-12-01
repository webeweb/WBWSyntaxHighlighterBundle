<?php

/**
 * This file is part of the syntaxhighlighter-bundle package.
 *
 * (c) 2017 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\SyntaxHighlighterBundle\Tests\Twig\Extension;

use Exception;
use Twig_Node;
use Twig_SimpleFilter;
use Twig_SimpleFunction;
use WBW\Bundle\SyntaxHighlighterBundle\API\SyntaxHighlighterConfig;
use WBW\Bundle\SyntaxHighlighterBundle\API\SyntaxHighlighterDefaults;
use WBW\Bundle\SyntaxHighlighterBundle\API\SyntaxHighlighterStrings;
use WBW\Bundle\SyntaxHighlighterBundle\Tests\AbstractFrameworkTestCase;
use WBW\Bundle\SyntaxHighlighterBundle\Twig\Extension\SyntaxHighlighterTwigExtension;
use WBW\Library\Core\Exception\FileSystem\FileNotFoundException;

/**
 * SyntaxHighlighter Twig extension test.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Bundle\SyntaxHighlighterBundle\Tests\Twig\Extension
 */
class SyntaxHighlighterTwigExtensionTest extends AbstractFrameworkTestCase {

    /**
     * SyntaxHighlighter config.
     *
     * @var SyntaxHighlighterConfig
     */
    private $syntaxHighlighterConfig;

    /**
     * SyntaxHighlighter defaults.
     *
     * @var SyntaxHighlighterDefaults
     */
    private $syntaxHighlighterDefaults;

    /**
     * SyntaxHighlighter strings.
     *
     * @var SyntaxHighlighterStrings
     */
    private $syntaxHighlighterStrings;

    /**
     * {@inheritdoc}
     */
    protected function setUp() {
        parent::setUp();

        // Set a SyntaxHighlighter config mock.
        $this->syntaxHighlighterConfig = new SyntaxHighlighterConfig();

        // Set a SyntaxHighlighter defauls mock.
        $this->syntaxHighlighterDefaults = new SyntaxHighlighterDefaults();

        // Set a SyntaxHighlighter strings mock.
        $this->syntaxHighlighterStrings = new SyntaxHighlighterStrings();
    }

    /**
     * Tests the __construct() method.
     *
     * @return void
     */
    public function testConstrut() {

        $this->assertEquals("webeweb.syntaxhighlighter.twig.extension.syntaxhighlighter", SyntaxHighlighterTwigExtension::SERVICE_NAME);
    }

    /**
     * Tests the getFilters() method.
     *
     * @return void
     */
    public function testGetFilters() {

        $obj = new SyntaxHighlighterTwigExtension($this->twigEnvironment);

        $res = $obj->getFilters();
        $this->assertCount(1, $res);

        $this->assertInstanceOf(Twig_SimpleFilter::class, $res[0]);
        $this->assertEquals("syntaxHighlighterScript", $res[0]->getName());
        $this->assertEquals([$obj, "syntaxHighlighterScriptFilter"], $res[0]->getCallable());
        $this->assertEquals(["html"], $res[0]->getSafe(new Twig_Node()));
    }

    /**
     * Tests the getFunctions() method.
     *
     * @return void
     */
    public function testGetFunctions() {

        $obj = new SyntaxHighlighterTwigExtension($this->twigEnvironment);

        $res = $obj->getFunctions();
        $this->assertCount(4, $res);

        $this->assertInstanceOf(Twig_SimpleFunction::class, $res[0]);
        $this->assertEquals("syntaxHighlighterConfig", $res[0]->getName());
        $this->assertEquals([$obj, "syntaxHighlighterConfigFunction"], $res[0]->getCallable());
        $this->assertEquals(["html"], $res[0]->getSafe(new Twig_Node()));

        $this->assertInstanceOf(Twig_SimpleFunction::class, $res[1]);
        $this->assertEquals("syntaxHighlighterContent", $res[1]->getName());
        $this->assertEquals([$obj, "syntaxHighlighterContentFunction"], $res[1]->getCallable());
        $this->assertEquals(["html"], $res[1]->getSafe(new Twig_Node()));

        $this->assertInstanceOf(Twig_SimpleFunction::class, $res[2]);
        $this->assertEquals("syntaxHighlighterDefaults", $res[2]->getName());
        $this->assertEquals([$obj, "syntaxHighlighterDefaultsFunction"], $res[2]->getCallable());
        $this->assertEquals(["html"], $res[2]->getSafe(new Twig_Node()));

        $this->assertInstanceOf(Twig_SimpleFunction::class, $res[3]);
        $this->assertEquals("syntaxHighlighterStrings", $res[3]->getName());
        $this->assertEquals([$obj, "syntaxHighlighterStringsFunction"], $res[3]->getCallable());
        $this->assertEquals(["html"], $res[3]->getSafe(new Twig_Node()));
    }

    /**
     * Tests the syntaxHighlighterConfigFunction() method.
     *
     * @return void
     * @depends testGetFunctions
     */
    public function testSyntaxHighlighterConfigFunction() {

        // Set the SYntaxHighlighter config mock.
        $this->syntaxHighlighterConfig->setBloggerMode(true);
        $this->syntaxHighlighterConfig->setStripBrs(true);
        $this->syntaxHighlighterConfig->setTagName("blocquote");

        $obj = new SyntaxHighlighterTwigExtension($this->twigEnvironment);

        $res = <<< EOT
SyntaxHighlighter.config.bloggerMode = true;
SyntaxHighlighter.config.stripBrs = true;
SyntaxHighlighter.config.tagName = "blocquote";
EOT;
        $this->assertEquals($res, $obj->syntaxHighlighterConfigFunction($this->syntaxHighlighterConfig));
    }

    /**
     * Tests the syntaxHighlighterConfigFunction() method.
     *
     * @return void
     * @depends testGetFunctions
     */
    public function testSyntaxHighlighterConfigFunctionWithStrings() {

        // Set the SYntaxHighlighter config mock.
        $this->syntaxHighlighterConfig->setBloggerMode(true);
        $this->syntaxHighlighterConfig->setStripBrs(true);
        $this->syntaxHighlighterConfig->setTagName("blocquote");

        $this->syntaxHighlighterConfig->setStrings($this->syntaxHighlighterStrings);

        $obj = new SyntaxHighlighterTwigExtension($this->twigEnvironment);

        $res = <<< EOT
SyntaxHighlighter.config.bloggerMode = true;
SyntaxHighlighter.config.stripBrs = true;
SyntaxHighlighter.config.tagName = "blocquote";
SyntaxHighlighter.config.strings.alert = "SyntaxHighlighter

";
SyntaxHighlighter.config.strings.brushNotHtmlScript = "Brush wasn't made for html-script option:";
SyntaxHighlighter.config.strings.copyToClipboard = "copy to clipboard";
SyntaxHighlighter.config.strings.copyToClipboardConfirmation = "The code is in your clipboard now";
SyntaxHighlighter.config.strings.expandSource = "+ expand source";
SyntaxHighlighter.config.strings.help = "?";
SyntaxHighlighter.config.strings.noBrush = "Can't find brush for:";
SyntaxHighlighter.config.strings.print = "print";
SyntaxHighlighter.config.strings.viewSource = "view source";
EOT;
        $this->assertEquals($res, $obj->syntaxHighlighterConfigFunction($this->syntaxHighlighterConfig));
    }

    /**
     * Tests the syntaxHighlighterContentFunction() method.
     *
     * @return void
     * @depends testGetFunctions
     */
    public function testSyntaxHighlighterContentFunction() {

        $obj = new SyntaxHighlighterTwigExtension($this->twigEnvironment);

        $arg = ["content" => "<span>span</span>", "language" => "html"];
        $res = <<< EOT
<pre class="brush: html">
&lt;span&gt;span&lt;/span&gt;
</pre>
EOT;
        $this->assertEquals($res, $obj->syntaxHighlighterContentFunction($arg));
    }

    /**
     * Tests the syntaxHighlighterContentFunction() method.
     *
     * @return void
     * @depends testGetFunctions
     */
    public function testSyntaxHighlighterContentFunctionWithFilename() {

        $obj = new SyntaxHighlighterTwigExtension($this->twigEnvironment);

        $arg = ["filename" => getcwd() . "/SyntaxHighlighterBundle.php", "language" => "php"];
        $res = <<< EOT
<pre class="brush: php">
&lt;?php

/**
 * This file is part of the syntaxhighligter-bundle package.
 *
 * (c) 2017 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\SyntaxHighlighterBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use WBW\Bundle\CoreBundle\Provider\AssetsProviderInterface;

/**
 * SyntaxHighlighter bundle.
 *
 * @author webeweb &lt;https://github.com/webeweb/&gt;
 * @package WBW\Bundle\SyntaxHighlighterBundle
 */
class SyntaxHighlighterBundle extends Bundle implements AssetsProviderInterface {

    /**
     * {@inheritdoc}
     */
    public function getAssetsRelativeDirectory() {
        return &quot;/Resources/assets&quot;;
    }

}

</pre>
EOT;
        $this->assertEquals($res, $obj->syntaxHighlighterContentFunction($arg));
    }

    /**
     * Tests the syntaxHighlighterContentFunction() method.
     *
     * @return void
     * @depends testGetFunctions
     */
    public function testSyntaxHighlighterContentFunctionWithFileNotFoundException() {

        $obj = new SyntaxHighlighterTwigExtension($this->twigEnvironment);

        $arg = ["filename" => getcwd() . "/SyntaxHighlighterBundle"];

        try {

            $obj->syntaxHighlighterContentFunction($arg);
        } catch (Exception $ex) {

            $this->assertInstanceOf(FileNotFoundException::class, $ex);
            $this->assertContains("syntaxhighlighter-bundle/SyntaxHighlighterBundle\" is not found", $ex->getMessage());
        }
    }

    /**
     * Tests the syntaxHighlighterDefaultsFunction() method.
     *
     * @return void
     * @depends testGetFunctions
     */
    public function testSyntaxHighlighterDefaultsFunction() {

        // Set the SyntaxHighlighter defaults mock.
        $this->syntaxHighlighterDefaults->setAutoLinks(false);
        $this->syntaxHighlighterDefaults->setClassName("classname");
        $this->syntaxHighlighterDefaults->setCollapse(true);
        $this->syntaxHighlighterDefaults->setFirstLine(0);
        $this->syntaxHighlighterDefaults->setGutter(false);
        $this->syntaxHighlighterDefaults->setHighlight([1, 2, 3]);
        $this->syntaxHighlighterDefaults->setHtmlScript(true);
        $this->syntaxHighlighterDefaults->setSmartTabs(false);
        $this->syntaxHighlighterDefaults->setTabSize(8);
        $this->syntaxHighlighterDefaults->setToolbar(false);

        $obj = new SyntaxHighlighterTwigExtension($this->twigEnvironment);

        $res = <<<'EOT'
SyntaxHighlighter.defaults['auto-links'] = false;
SyntaxHighlighter.defaults['class-name'] = "classname";
SyntaxHighlighter.defaults['collapse'] = true;
SyntaxHighlighter.defaults['first-line'] = 0;
SyntaxHighlighter.defaults['gutter'] = false;
SyntaxHighlighter.defaults['highlight'] = [1,2,3];
SyntaxHighlighter.defaults['html-script'] = true;
SyntaxHighlighter.defaults['smart-tabs'] = false;
SyntaxHighlighter.defaults['tab-size'] = 8;
SyntaxHighlighter.defaults['toolbar'] = false;
EOT;
        $this->assertEquals($res, $obj->syntaxHighlighterDefaultsFunction($this->syntaxHighlighterDefaults));
    }

    /**
     * Tests the syntaxHighlighterScriptFilter() method.
     *
     * @return void
     * @depends testGetFilters
     */
    public function testSyntaxHighlighterScriptFilter() {

        $obj = new SyntaxHighlighterTwigExtension($this->twigEnvironment);

        $res = "<script type=\"text/javascript\">\ncontent\n</script>";
        $this->assertEquals($res, $obj->syntaxHighlighterScriptFilter("content"));
    }

    /**
     * Tests the syntaxHighlighterStringsFunction() method.
     *
     * @return void
     * @depends testGetFunctions
     */
    public function testSyntaxHighlighterStringsFunction() {

        // Set the SyntaxHighlighter strings mock.
        $this->syntaxHighlighterStrings->setAlert("SyntaxHighlighter bundle");
        $this->syntaxHighlighterStrings->setBrushNotHtmlScript("Brush wasn't made for HTML-Script option :");
        $this->syntaxHighlighterStrings->setCopyToClipboard("Copy to clipboard");
        $this->syntaxHighlighterStrings->setCopyToClipboardConfirmation("Operation success");
        $this->syntaxHighlighterStrings->setExpandSource("Expand source");
        $this->syntaxHighlighterStrings->setHelp("Help");
        $this->syntaxHighlighterStrings->setNoBrush("Can't find brush for :");
        $this->syntaxHighlighterStrings->setPrint("Print");
        $this->syntaxHighlighterStrings->setViewSource("View source");

        $obj = new SyntaxHighlighterTwigExtension($this->twigEnvironment);

        $res = <<< EOT
SyntaxHighlighter.config.strings.alert = "SyntaxHighlighter bundle";
SyntaxHighlighter.config.strings.brushNotHtmlScript = "Brush wasn't made for HTML-Script option :";
SyntaxHighlighter.config.strings.copyToClipboard = "Copy to clipboard";
SyntaxHighlighter.config.strings.copyToClipboardConfirmation = "Operation success";
SyntaxHighlighter.config.strings.expandSource = "Expand source";
SyntaxHighlighter.config.strings.help = "Help";
SyntaxHighlighter.config.strings.noBrush = "Can't find brush for :";
SyntaxHighlighter.config.strings.print = "Print";
SyntaxHighlighter.config.strings.viewSource = "View source";
EOT;
        $this->assertEquals($res, $obj->syntaxHighlighterStringsFunction($this->syntaxHighlighterStrings));
    }

}
