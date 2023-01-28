<?php

namespace Tests\Exan\Dhp\Rest\Helpers\Channel\Channel\Shared;

use Exan\Dhp\Const\Validation\RateLimit;
use Exan\Dhp\Rest\Helpers\Channel\Channel\Shared\SetDefaultThreadRateLimitPerUser;
use PHPUnit\Framework\TestCase;

class SetDefaultThreadRateLimitPerUserTest extends TestCase
{
    public function testSetThreadRateLimitPerUser()
    {
        $class = new class extends DummyTraitTester {
            use SetDefaultThreadRateLimitPerUser;
        };

        $class->setDefaultThreadRateLimitPerUser(RateLimit::MIN + 1);

        $this->assertEquals(['default_thread_rate_limit_per_user' => RateLimit::MIN + 1], $class->get());
    }

    public function testSetThreadRateLimitAboveMaxPerUser()
    {
        $class = new class extends DummyTraitTester {
            use SetDefaultThreadRateLimitPerUser;
        };

        $class->setDefaultThreadRateLimitPerUser(RateLimit::MAX + 1);

        $this->assertEquals(['default_thread_rate_limit_per_user' => RateLimit::MAX], $class->get());
    }

    public function testSetThreadRateLimitBelowMinPerUser()
    {
        $class = new class extends DummyTraitTester {
            use SetDefaultThreadRateLimitPerUser;
        };

        $class->setDefaultThreadRateLimitPerUser(RateLimit::MIN - 1);

        $this->assertEquals(['default_thread_rate_limit_per_user' => RateLimit::MIN], $class->get());
    }
}