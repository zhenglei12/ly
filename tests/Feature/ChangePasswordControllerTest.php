<?php

namespace Cherish\Ly\Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Cherish\Ly\AdminUserFactory;

class ChangePasswordControllerTest extends FeatureTestCase
{
    public function test_change_password()
    {
        $newPassword = 'new-mojito-password';

        $user = Auth::user();

        $user->password = bcrypt('mojito-password');
        $user->save();

        $response = $this->patch(route('user.change-password'), [
            'old_password' => 'mojito-password',
            'password' => $newPassword,
            'password_confirmation' => $newPassword
        ]);

        $response->assertStatus(204);

        $user = AdminUserFactory::adminUser()->find($user->id);

        $this->assertTrue(Hash::check($newPassword, $user->password), $user->password);
    }
}
