<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    public function testBasicTest()
    {
        $response = $this->get('/apiList');

        $response->assertStatus(200);
    }

}