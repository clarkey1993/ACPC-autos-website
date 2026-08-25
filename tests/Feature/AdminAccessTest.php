<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/admin/dashboard')->assertRedirect('/login');
    }

    public function test_authenticated_user_not_on_allowlist_is_forbidden(): void
    {
        config(['dealer.admin_emails' => ['admin@example.com']]);
        $user = User::factory()->create(['email' => 'other@example.com']);

        $this->actingAs($user)->get('/admin/dashboard')->assertForbidden();
    }

    public function test_allowlisted_user_can_access_admin(): void
    {
        config(['dealer.admin_emails' => ['admin@example.com']]);
        $user = User::factory()->create(['email' => 'ADMIN@example.com']);

        $this->actingAs($user)->get('/admin/dashboard')->assertOk();
    }

    public function test_empty_allowlist_fails_closed(): void
    {
        config(['dealer.admin_emails' => []]);
        $user = User::factory()->create();

        $this->actingAs($user)->get('/admin/dashboard')->assertForbidden();
    }
}
