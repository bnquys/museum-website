<?php
namespace Museum\Utils;

use Symfony\Component\CssSelector\CssSelectorConverter;
use DOMDocument;
use DOMXPath;
use DOMElement;

class HtmlManipulator
{
    /**
     * @var DOMDocument
     */
    protected $dom;

    /**
     * @var DOMXPath
     */
    protected $xpath;

    /**
     * @var CssSelectorConverter
     */
    protected $cssConverter;

    /**
     * Constructor.
     *
     * Initializes the DOMDocument with provided HTML content and prepares XPath and CSS selector converter.
     *
     * @param string $html The HTML fragment to manipulate.
     */
    public function __construct($html)
    {
        libxml_use_internal_errors(true);

        $this->dom = new DOMDocument();
        $this->dom->loadHTML('<?xml encoding="utf-8" ?>' . $html); // keep UTF-8

        $this->xpath = new DOMXPath($this->dom);
        $this->cssConverter = new CssSelectorConverter();
    }

    /**
     * Adds one or more CSS classes to elements matching the given CSS selector.
     *
     * @param string $selector   CSS selector to find target elements.
     * @param string $className  One or more class names separated by spaces.
     */
    public function addClass($selector, $className)
    {
        $xpathQuery = $this->cssConverter->toXPath($selector);
        $nodes = $this->xpath->query($xpathQuery);

        foreach ($nodes as $node) {
            /** @var DOMElement $node */
            $existingClass = $node->getAttribute('class');
            $classes = preg_split('/\s+/', $existingClass, -1, PREG_SPLIT_NO_EMPTY);
            $newClasses = preg_split('/\s+/', $className, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($newClasses as $cls) {
                if (!in_array($cls, $classes)) {
                    $classes[] = $cls;
                }
            }

            $node->setAttribute('class', implode(' ', $classes));
        }
    }

    /**
     * Returns the manipulated HTML fragment (everything inside <body> only).
     *
     * @return string HTML content with modifications.
     */
    public function getHtml()
    {
        $body = $this->dom->getElementsByTagName('body')->item(0);
        return $this->innerHTML($body);
    }

    /**
     * Extracts inner HTML from a given DOM element.
     *
     * @param DOMElement $element The element whose inner HTML is extracted.
     * @return string The inner HTML content.
     */
    private function innerHTML($element)
    {
        $innerHTML = '';
        foreach ($element->childNodes as $child) {
            $innerHTML .= $this->dom->saveHTML($child);
        }
        return $innerHTML;
    }
}