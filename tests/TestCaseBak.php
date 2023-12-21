<?php

namespace Tests;

use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use DDD\Domain\Services\Service;
use DDD\Domain\Base\Users\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    public function authUser()
    {
        $user = $this->createUser();
        Sanctum::actingAs($user);
        return $user;
    }

    public function createUser($args = [])
    {
        return User::factory()->create($args);
    }

    public function createWebService($args = [])
    {
        return Service::factory()->create($args);
    }
}
