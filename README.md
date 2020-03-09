# Serializer

Library to transform objects to arrays using ReflectionClass

## Installation
```
$ composer require cyradin/serializer
```
## Usage
```php
<?php

use Cyradin\Serializer\Context;
use Cyradin\Serializer\Serializer;
use Cyradin\Serializer\Enum\LetterCase;

$context = new Context();
$context->setCase(LetterCase::FORMAT_SNAKE_CASE); // transform property names to snake case
$context->setSerializeNull(true); // do not skip null property values

$serializer = new Serializer($context);
/** @var object|\DateTimeInterface|string|float|int|null $object */
$result = $serializer->normalize($object);
```
