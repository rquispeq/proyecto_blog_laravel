<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_screen()
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
    }

    public function test_login_successfully(){
        $password = 'admin_password';
        $admin = User::factory()->admin()->create([
            'password' => Hash::make($password)
        ]);

        $this->from('/admin/login')->post('/admin/login',[
            'email' => $admin->email,
            'password' => $password
        ]);

        $this->assertAuthenticatedAs($admin);
        $response = $this->get(route('admin.home'));
        $response->assertStatus(200);

    }

    public function test_admin_view_home_dashboard(){
        $password = 'admin_password';
        $admin = User::factory()->admin()->create([
            'password' => Hash::make($password)
        ]);

        $this->actingAs($admin);
        $this->assertAuthenticatedAs($admin);
        $response = $this->get(route('admin.home'));
        $response->assertStatus(200);
    }

    public function test_user_cant_access_admin_panel(){
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);
        $response = $this->get(route('admin.home'));
        $response->assertStatus(302);
    }
}
