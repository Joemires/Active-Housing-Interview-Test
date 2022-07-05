<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserTableSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\CreatesApplication;
use Tests\TestCase;

class GetUserAPITest extends TestCase
{
    use CreatesApplication, RefreshDatabase, DatabaseMigrations;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Run a specific seeder before each test.
     *
     * @var string
     */
    protected $seeder = UserTableSeeder::class;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_users_example()
    {
        $response = $this->getJson("/api/users");
        $response
                ->assertJson(fn (AssertableJson $json) =>
                    $json->where('status', 200)
                            ->where('success', true)
                            ->etc()
                );
    }

    public function test_get_single_user_example()
    {
        $user_id = User::inRandomOrder()->first()->id;

        $response = $this->getJson("/api/users/$user_id");
        $response
                ->assertJson(fn (AssertableJson $json) =>
                    $json->where('status', 200)
                            ->where('success', true)
                            ->etc()
                );
    }
}
