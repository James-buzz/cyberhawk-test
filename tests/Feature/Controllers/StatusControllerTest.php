<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;

class StatusControllerTest extends TestCase
{
    public function test_status()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
