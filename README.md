# Serializer

Library to transform objects to arrays using ReflectionClass

## Installation
```
$ composer require cyradin/serializer
```
## Usage
```php
<?php

use Cyradin\Serializer\Serializer;
use Cyradin\Serializer\Enum\LetterCase;
use Cyradin\Serializer\Normalizer\ReflectionNormalizer;
use Cyradin\Serializer\Factory\FormatterFactory;
use Cyradin\Serializer\Factory\ContextFactory;

$normalizer = new ReflectionNormalizer();
$factory = new ContextFactory(new FormatterFactory());

$serializer = new Serializer($factory, $normalizer);
/** @var object|object[] $object */
$result = $serializer->toArray($object);

$context = $factory->createSerializerContext();
$context->setCase(LetterCase::FORMAT_SNAKE_CASE); // transform property names to snake case
$context->setSerializeNull(true); // do not skip null property values

/** @var object|object[] $object */
$result = $serializer->toArray($object);
```
