<?php

namespace Miatoro\Tether\BbCode\Tag;

class Tether
{
    /**
     * Render the tether BBCode
     *
     * @param array $children
     * @param string $option The tether identifier (e.g., "name-of-tether")
     * @param array $tag
     * @param array $options
     * @param \XF\BbCode\Renderer\AbstractRenderer $renderer
     * @return string
     */
    public static function render($children, $option, $tag, array $options, \XF\BbCode\Renderer\AbstractRenderer $renderer)
    {
        // Get the text content (e.g., "positive1,negative5")
        $text = $renderer->renderSubTree($children, $options);
        $text = trim($text);

        // Get the tether identifier from the option
        $identifier = trim($option);

        if (empty($identifier))
        {
            return ''; // No identifier, return empty
        }

        // Parse the positive and negative values
        $parsed = self::parseValues($text);

        // Get the tether from the database
        /** @var \Miatoro\Tether\Repository\Tether $tetherRepo */
        $tetherRepo = \XF::repository('Miatoro\Tether:Tether');
        $tether = $tetherRepo->getTetherByIdentifier($identifier);

        // If rendering HTML
        if ($renderer instanceof \XF\BbCode\Renderer\Html)
        {
            $templater = \XF::app()->templater();

            return $templater->renderTemplate('public:miatoro_tether_bbcode', [
                'identifier' => $identifier,
                'tether' => $tether,
                'positiveValue' => $parsed['positive'],
                'negativeValue' => $parsed['negative']
            ]);
        }
        // For other renderers (email, plain text, etc.)
        else
        {
            if ($tether)
            {
                return '[' . $tether->title . ']';
            }
            else
            {
                return '[Tether: ' . $identifier . ']';
            }
        }
    }

    /**
     * Parse the positive and negative values from the BBCode content
     *
     * Expected format: "positive1,negative5" or "negative3,positive2"
     *
     * @param string $text
     * @return array ['positive' => int, 'negative' => int]
     */
    protected static function parseValues($text)
    {
        $positive = 0;
        $negative = 0;

        // Split by comma
        $parts = array_map('trim', explode(',', $text));

        foreach ($parts as $part)
        {
            // Match "positive" followed by a number
            if (preg_match('/^positive(\d+)$/i', $part, $matches))
            {
                $positive = (int)$matches[1];
            }
            // Match "negative" followed by a number
            elseif (preg_match('/^negative(\d+)$/i', $part, $matches))
            {
                $negative = (int)$matches[1];
            }
        }

        return [
            'positive' => $positive,
            'negative' => $negative
        ];
    }
}
