<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$permissions = [
			['can-access-all-users'],
			['can-create-task'],
			['can-view-task'],
			['can-delete-task'],
			['can-update-task'],
			['can-reassign-task'],
			['can-view-teams'],
			['can-create-teams'],
			['can-update-teams'],
			['can-view-specific-team'],
			['can-delete-team'],
			['can-view-members'],
			['can-create-members'],
			['can-view-specific-member'],
			['can-update-member'],
			['can-delete-member'],
			['can-add-department'],
			['can-update-department'],
			['can-delete-department'],
			['can-view-department'],
		];

		foreach ($permissions as $permission) {
			\App\Models\Permission::create([
				'name' => $permission[0],
				'guard_name' => 'web',
			]);
		}
	}
}
