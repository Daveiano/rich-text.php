<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2019 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeRenderer;

use Contentful\RichText\Node\Heading1 as NodeClass;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\RendererInterface;

class Heading1 implements NodeRendererInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports(NodeInterface $node): bool
    {
        return $node instanceof NodeClass;
    }

    /**
     * {@inheritdoc}
     */
    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string
    {
        /* @var NodeClass $node */
        if (!$node instanceof NodeClass) {
            throw new \LogicException(\sprintf(
                'Trying to use node renderer "%s" to render unsupported node of class "%s".',
                \get_class($this),
                \get_class($node)
            ));
        }

        return '<h1>'.$renderer->renderCollection($node->getContent()).'</h1>';
    }
}
