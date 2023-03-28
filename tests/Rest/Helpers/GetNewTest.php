<?php

declare(strict_types=1);

namespace Ragnarok\Fenrir;

use Ragnarok\Fenrir\Rest\Helpers\GetNew;
use PHPUnit\Framework\TestCase;

class GetNewTest extends TestCase
{
    public function testGetNew(): void
    {
        $class = new class {
            use GetNew;
        };

        $this->assertTrue(
            $class::new() instanceof $class,
            'Class is not correct instance'
        );
    }
}
