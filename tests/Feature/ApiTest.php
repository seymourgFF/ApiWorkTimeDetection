<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Worker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;


    public function test_api_start_auth(): void
    {
        $worker = Worker::factory()->create();
        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer '. config('apiTokens')['token'],
            ])
            ->get('/api/work/start/1');

        $response->assertStatus(200);
    }

    public function test_api_start_no_auth(): void
    {
        $worker = Worker::factory()->create();
        $response = $this->get('/api/work/start/1');

        $response->assertStatus(302);
    }

    public function test_api_stop_auth(): void
    {
        $worker = Worker::factory()->create();
        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer '. config('apiTokens')['token'],
            ])
            ->get('/api/work/stop/1');

        $response->assertStatus(200);
    }

    public function test_api_stop_no_auth(): void
    {
        $worker = Worker::factory()->create();
        $response = $this->get('/api/work/stop/1');

        $response->assertStatus(302);
    }
}
