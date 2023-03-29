<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Worker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_login(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_register(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_password_reset(): void
    {
        $response = $this->get('/password/reset');

        $response->assertStatus(200);
    }

    public function test_home_auth(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(200);
    }

    public function test_home_no_auth(): void
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
    }

    public function test_workers(): void
    {
        $response = $this->get('/workers');

        $response->assertStatus(200);
    }

    public function test_workers_upload_auth(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/workers/upload');

        $response->assertStatus(200);
    }

    public function test_workers_upload_no_auth(): void
    {
        $response = $this->get('/workers/upload');

        $response->assertStatus(302);
    }

    public function test_workers_show(): void
    {

        $worker = Worker::factory()->create();

        $response = $this->get('/workers/1');

        $response->assertStatus(200);
    }

}
