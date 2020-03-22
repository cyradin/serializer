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


## Benchmark

```
$ composer benchmark
```

##### Normalizer

| normalizer       | 1      | 100    | 10000  |
| -----------------|:------:| ------:|-------:|
| symfony get-set  |0.000291|0.016245|1.446671|
| symfony object   |0.000369|0.020275|2.014218|
| symfony property |0.000161|0.008775|0.835745|
| jms              |0.005103|0.015551|1.250648|
| this package     |0.000296|0.004986|0.467005|
