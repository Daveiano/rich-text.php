<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Implementation;

use Contentful\StructuredText\Node\NodeInterface;
use Contentful\StructuredText\NodeRenderer\NodeRendererInterface;
use Contentful\StructuredText\RendererInterface;
use Twig\Environment;

/**
 * Basic implementation of NodeRendererInterface for testing purposes.
 *
 * This implementation demonstrates how delegating
 * to an actual templating engine might work.
 */
class TwigNodeRenderer implements NodeRendererInterface
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(NodeInterface $node): bool
    {
        return \true;
    }

    /**
     * {@inheritdoc}
     */
    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string
    {
        $template = $this->twig
            ->createTemplate('This is a node with type "{{ name }}" with context var set to "{{ contextVar }}".')
        ;

        return $template->render([
            'name' => $node->getType(),
            'contextVar' => $context['contextVar'],
        ]);
    }
}