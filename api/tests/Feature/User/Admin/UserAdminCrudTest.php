<?php

namespace Tests\Feature\User\Admin;

use App\Features\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserAdminCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_filters_users_and_returns_pagination_meta(): void
    {
        for ($index = 1; $index <= 51; $index++) {
            $this->createUser([
                'name' => "Target User {$index}",
                'email' => "target{$index}@example.com",
                'status' => 1,
            ]);
        }

        $this->createUser([
            'name' => 'Other User',
            'email' => 'other@example.net',
            'status' => 0,
        ]);

        $response = $this->getJson('/admin/user/list?name=Target&email=%40example.com&status=1');

        $response
            ->assertOk()
            ->assertJsonCount(50, 'data')
            ->assertJsonPath('meta.current_page', 1)
            ->assertJsonPath('meta.last_page', 2)
            ->assertJsonPath('meta.per_page', 50)
            ->assertJsonPath('meta.total', 51)
            ->assertJsonMissing(['password', 'remember_token', 'facebook_access_token', 'google_access_token']);
    }

    public function test_user_routes_reject_non_numeric_ids(): void
    {
        $this->getJson('/admin/user/not-a-number')->assertNotFound();
        $this->patchJson('/admin/user/not-a-number/update')->assertNotFound();
        $this->deleteJson('/admin/user/not-a-number/delete')->assertNotFound();
    }

    public function test_store_hashes_password_and_redacts_sensitive_fields(): void
    {
        $payload = $this->validPayload([
            'email' => 'created@example.com',
            'password' => 'plain-secret',
        ]);

        $response = $this->postJson('/admin/user/store', $payload);

        $response
            ->assertCreated()
            ->assertJsonPath('email', 'created@example.com')
            ->assertJsonMissing(['password', 'remember_token', 'facebook_access_token', 'google_access_token']);

        $user = User::query()->where('email', 'created@example.com')->firstOrFail();

        $this->assertTrue(Hash::check('plain-secret', $user->getRawOriginal('password')));
        $this->assertNotSame('plain-secret', $user->getRawOriginal('password'));
    }

    public function test_show_returns_user_and_missing_user_fails_validation(): void
    {
        $user = $this->createUser(['email' => 'shown@example.com']);

        $this->getJson("/admin/user/{$user->id}")
            ->assertOk()
            ->assertJsonPath('id', $user->id)
            ->assertJsonPath('email', 'shown@example.com')
            ->assertJsonMissing(['password', 'remember_token', 'facebook_access_token', 'google_access_token']);

        $this->getJson('/admin/user/999999')
            ->assertUnprocessable()
            ->assertJsonValidationErrors('id');
    }

    public function test_patch_updates_only_supplied_fields_and_enforces_unique_email(): void
    {
        $user = $this->createUser([
            'name' => 'Before',
            'email' => 'before@example.com',
            'company' => 'Original Company',
        ]);
        $other = $this->createUser(['email' => 'taken@example.com']);
        $originalPassword = $user->getRawOriginal('password');

        $this->patchJson("/admin/user/{$user->id}/update", [
            'name' => 'After',
            'company' => null,
        ])
            ->assertOk()
            ->assertJsonPath('name', 'After')
            ->assertJsonPath('company', null)
            ->assertJsonPath('email', 'before@example.com');

        $user->refresh();
        $this->assertSame($originalPassword, $user->getRawOriginal('password'));

        $this->patchJson("/admin/user/{$user->id}/update", [
            'email' => $other->email,
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('email');

        $this->patchJson("/admin/user/{$user->id}/update", [
            'email' => $user->email,
            'password' => 'replacement-secret',
        ])->assertOk();

        $this->assertTrue(Hash::check(
            'replacement-secret',
            $user->refresh()->getRawOriginal('password'),
        ));
    }

    public function test_delete_removes_user_and_returns_no_content(): void
    {
        $user = $this->createUser();

        $this->deleteJson("/admin/user/{$user->id}/delete")->assertNoContent();

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    private function createUser(array $overrides = []): User
    {
        return User::query()->create(array_merge($this->validPayload(), $overrides));
    }

    private function validPayload(array $overrides = []): array
    {
        static $sequence = 0;
        $sequence++;

        return array_merge([
            'name' => 'Admin Managed User',
            'email' => "user{$sequence}@example.com",
            'company' => null,
            'phone' => null,
            'password' => 'initial-secret',
            'country' => 'US',
            'city' => 'New York',
            'address' => '1 Main Street',
            'status' => 1,
            'wholesale' => false,
            'wholesale_profile' => 0,
            'total_sum' => '10.50',
            'email_verified_at' => null,
        ], $overrides);
    }
}
