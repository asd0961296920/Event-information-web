<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace OpenApi\Processors\Concerns;

use OpenApi\Analysis;
use OpenApi\Annotations\Components;
use OpenApi\Annotations\Property;
use OpenApi\Annotations\Schema;
use OpenApi\Context;
use OpenApi\Generator;

/**
 * Steps:
 * 1. Determine direct parent / interfaces / traits
 * 2. With each:
 *    - traverse up inheritance tree
 *      - inherit from first with schema; all other with scheme can be ignored
 *      - merge from all without schema
 *        => update all $ref that might reference a property merged.
 */
trait MergeTrait
{
    protected function inheritFrom(Analysis $analysis, Schema $schema, Schema $from, string $refPath, Context $context): void
    {
        if (Generator::isDefault($schema->allOf)) {
            $schema->allOf = [];
        }
        // merging other properties into allOf is done in the AugmentSchemas processor
        $schema->allOf[] = $refSchema = new Schema([
            'ref' => Components::ref($refPath),
            '_context' => $context,
            '_aux' => true,
        ]);
        $analysis->addAnnotation($refSchema, $refSchema->_context);
    }

    protected function mergeAnnotations(Schema $schema, array $from, array &$existing): void
    {
        if (is_iterable($from['context']->annotations)) {
            foreach ($from['context']->annotations as $annotation) {
                if ($annotation instanceof Property && !in_array($annotation->_context->property, $existing, true)) {
                    $existing[] = $annotation->_context->property;
                    $schema->merge([$annotation], true);
                }
            }
        }
    }

    protected function mergeProperties(Schema $schema, array $from, array &$existing): void
    {
        foreach ($from['properties'] as $method) {
            if (is_iterable($method->annotations)) {
                foreach ($method->annotations as $annotation) {
                    if ($annotation instanceof Property && !in_array($annotation->_context->property, $existing, true)) {
                        $existing[] = $annotation->_context->property;
                        $schema->merge([$annotation], true);
                    }
                }
            }
        }
    }

    protected function mergeMethods(Schema $schema, array $from, array &$existing): void
    {
        foreach ($from['methods'] as $method) {
            if (is_iterable($method->annotations)) {
                foreach ($method->annotations as $annotation) {
                    if ($annotation instanceof Property && !in_array($annotation->_context->property, $existing, true)) {
                        $existing[] = $annotation->_context->property;
                        $schema->merge([$annotation], true);
                    }
                }
            }
        }
    }
}
