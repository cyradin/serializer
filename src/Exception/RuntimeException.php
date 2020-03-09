<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Exception;

use RuntimeException as BaseRuntimeException;

/**
 * Class RuntimeException
 *
 * @package Cyradin\Serializer\Exception
 */
class RuntimeException extends BaseRuntimeException implements SerializerExceptionInterface
{

}
