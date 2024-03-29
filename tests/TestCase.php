<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations, DatabaseTransactions;
    
    /**
     * Reset the migrations
     */
    protected function tearDown() :void
    {
        $this->artisan('migrate:reset');
        parent::tearDown();
    }
}
