<?php

/*
 * This file is part of the WBWSyntaxHighlighterBundle package.
 *
 * (c) 2017 NdC/WBW
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\SyntaxHighlighterBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFunction;
use WBW\Library\Core\Exception\File\FileNotFoundException;

/**
 * SyntaxHighlighter Twig extension.
 *
 * @author NdC/WBW <https://github.com/webeweb/>
 * @package WBW\Bundle\SyntaxHighlighterBundle\Twig\Extension
 * @final
 */
final class SyntaxHighlighterTwigExtension extends Twig_Extension {

	/**
	 * Service name.
	 */
	const SERVICE_NAME = "webeweb.syntaxhighlighter-bundle.twig.extension.syntaxhighlighter";

	/**
	 * Directory.
	 *
	 * @var string
	 */
	private $directory;

	/**
	 * Environment.
	 *
	 * @var string
	 */
	private $environment;

	/**
	 * Constructor.
	 *
	 * @param string $directory The directory.
	 * @param string $environment The environment.
	 */
	public final function __construct($directory, $environment) {
		$this->directory	 = $directory;
		$this->environment	 = $environment;
	}

	/**
	 * Get the Twig functions.
	 *
	 * @return array Returns the Twig functions.
	 */
	public function getFunctions() {
		return [
			new Twig_SimpleFunction('syntaxHighlighterScript', [$this, 'syntaxHighlighterScriptFunction'], ['is_safe' => ['html']]),
			new Twig_SimpleFunction('syntaxHighlighterStyle', [$this, 'syntaxHighlighterStyleFunction'], ['is_safe' => ['html']]),
		];
	}

	/**
	 * Get the resources directory.
	 *
	 * @return string Returns the resources directory.
	 */
	private function getResourcesDirectory() {
		return $this->directory . "/Resources";
	}

	/**
	 * Displays a SyntaxHighlighter resource.
	 *
	 * @param string $open The open.
	 * @param string $filename The filename.
	 * @param string $close The close.
	 * @throws FileNotFoundException Throws a SyntaxHighlighter file not found exception if the resource is not found.
	 */
	private function syntaxHighlighterResourceFunction($open, $filename, $close) {

		// Initialize and check the filepath.
		$filepath = $this->getResourcesDirectory() . "/public/" . $filename;
		if (!file_exists($filepath)) {
			throw new FileNotFoundException($filename);
		}

		// Return the output.
		return $open . $filename . $close;
	}

	/**
	 * Displays a SyntaxHighlighter script.
	 *
	 * @param string $script The script name.
	 * @param string $subdirectory The sub directory.
	 * @return string Returns the SyntaxHighlighter script.
	 * @throws FileNotFoundException Throws a file not found exception if the script is not found.
	 */
	public function syntaxHighlighterScriptFunction($script, $subdirectory = "js") {

		// Initialize the filename.
		$filename = implode("/", [$subdirectory, $script . ".js"]);

		// Return the output.
		return $this->syntaxHighlighterResourceFunction("<script src=\"/bundles/wbwsyntaxhighlighter/", $filename, "\" type=\"text/javascript\"></script>");
	}

	/**
	 * Displays a SyntaxHighlighter style.
	 *
	 * @param string $css The CSS name.
	 * @param string $subdirectory The sub directory.
	 * @return string Returns the SyntaxHighlighter style.
	 * @throws FileNotFoundException Throws a file not found exception if the CSS is not found.
	 */
	public function syntaxHighlighterStyleFunction($css, $subdirectory = "css") {

		// Initialize the filename.
		$filename = implode("/", [$subdirectory, $css . ".css"]);

		// Return the output.
		return $this->syntaxHighlighterResourceFunction("<link href=\"/bundles/wbwsyntaxhighlighter/", $filename, "\" rel=\"stylesheet\" type=\"text/css\">");
	}

	/**
	 * Determines if the environement is dev.
	 *
	 * @return boolean Returns true in case of success, false otherwise.
	 */
	private function isDevEnvironment() {
		return $this->environment === "dev";
	}

}
