<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    function actingAsAdmin(){
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);
        return $admin;
    }
}
