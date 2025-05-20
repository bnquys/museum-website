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

        if (empty(trim($html ?? ''))) {
            $html = '<p></p>';
        }

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

    public function print() : void {
        echo $this->getHtml();
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

    /**
     * Replaces the tag name of elements matched by the selector.
     *
     * For example: replace <div> with <section>, or <span> with <strong>.
     *
     * @param string $selector CSS selector to find target elements.
     * @param string $newTag   The new tag name to replace with.
     */
    public function replaceTag($selector, $newTag)
    {
        $xpathQuery = $this->cssConverter->toXPath($selector);
        $nodes = $this->xpath->query($xpathQuery);

        foreach ($nodes as $node) {
            /** @var DOMElement $node */

            // Create new element with desired tag
            $newElement = $this->dom->createElement($newTag);

            // Copy attributes
            foreach ($node->attributes as $attr) {
                $newElement->setAttribute($attr->nodeName, $attr->nodeValue);
            }

            // Move child nodes
            while ($node->firstChild) {
                $newElement->appendChild($node->removeChild($node->firstChild));
            }

            // Replace old node with new node
            $node->parentNode->replaceChild($newElement, $node);
        }
    }

    /**
     * Removes the HTML tag of elements matched by the selector,
     * keeping the inner content (text or child elements).
     *
     * For example: <span>Hello</span> => Hello
     *
     * @param string $selector CSS selector to find elements to unwrap.
     */
    public function removeTag($selector)
    {
        $xpathQuery = $this->cssConverter->toXPath($selector);
        $nodes = $this->xpath->query($xpathQuery);

        // Because we're modifying the DOM, collect elements first
        $toRemove = [];
        foreach ($nodes as $node) {
            /** @var DOMElement $node */
            $toRemove[] = $node;
        }

        foreach ($toRemove as $node) {
            $parent = $node->parentNode;

            // Move all child nodes before the element
            while ($node->firstChild) {
                $parent->insertBefore($node->removeChild($node->firstChild), $node);
            }

            // Remove the original tag
            $parent->removeChild($node);
        }
    }

}