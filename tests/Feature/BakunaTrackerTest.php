<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BakunaTrackerTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_is_available_to_guests_and_protected_pages_require_authentication(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('Health worker sign in');

        $this->get(route('dashboard'))->assertRedirect(route('login'));
        $this->get(route('schedule'))->assertRedirect(route('login'));
    }

    public function test_seeded_user_can_sign_in_view_pages_and_sign_out(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->assertDatabaseCount('vaccinations', 7);
        $this->assertDatabaseHas('vaccinations', [
            'patient_name' => 'Darcy Graves',
            'scheduled_at' => '2026-05-23 00:00:00',
        ]);

        $this->post(route('login.store'), [
            'email' => 'nurse.yuson@bakuna.test',
            'password' => 'bakuna2026',
        ])->assertRedirect(route('dashboard'));

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Vaccination schedule overview')
            ->assertSee('Hi, Paul')
            ->assertSee('John Doe')
            ->assertSee('Total schedules');

        $this->get(route('schedule'))
            ->assertOk()
            ->assertSee('Vaccination Schedule')
            ->assertSee('BCG')
            ->assertSee('Pentavalent')
            ->assertSee('OPV')
            ->assertSee('MMR')
            ->assertSee('Anti-Flu')
            ->assertSee('Darcy Graves')
            ->assertSee('May 23, 2026');

        $this->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->get(route('dashboard'))->assertRedirect(route('login'));
    }

    public function test_invalid_login_returns_a_validation_message(): void
    {
        $this->from(route('login'))
            ->post(route('login.store'), [
                'email' => 'unknown@bakuna.test',
                'password' => 'wrong-password',
            ])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors('email');
    }
}
