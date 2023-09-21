<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $user = User::factory()->create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => "12345678",

        ]);

        $user->givePermissionTo('can-access-all-users');
        $user->givePermissionTo('can-create-task');
        $user->givePermissionTo('can-view-task');
        $user->givePermissionTo('can-delete-task');
        $user->givePermissionTo('can-update-task');
        $user->givePermissionTo('can-reassign-task');
        $user->givePermissionTo('can-view-teams');
        $user->givePermissionTo('can-create-teams');
        $user->givePermissionTo('can-update-teams');
        $user->givePermissionTo('can-view-specific-team');
        $user->givePermissionTo('can-delete-team');
        $user->givePermissionTo('can-view-members');
        $user->givePermissionTo('can-create-members');
        $user->givePermissionTo('can-view-specific-member');
        $user->givePermissionTo('can-update-member');
        $user->givePermissionTo('can-delete-member');
        $user->givePermissionTo('can-add-department');
        $user->givePermissionTo('can-update-department');
        $user->givePermissionTo('can-delete-department');
        $user->givePermissionTo('can-view-department');
        $user->givePermissionTo('can-grant-permission');
    }
}
