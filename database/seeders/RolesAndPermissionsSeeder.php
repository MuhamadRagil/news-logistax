<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'articles.view',
            'articles.create',
            'articles.edit',
            'articles.delete',
            'articles.submit-review',
            'articles.approve',
            'articles.publish',
            'categories.manage',
            'tags.manage',
            'media.manage',
            'pages.manage',
            'users.manage',
            'settings.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $editor = Role::firstOrCreate(['name' => 'Editor', 'guard_name' => 'web']);
        $author = Role::firstOrCreate(['name' => 'Author', 'guard_name' => 'web']);

        $superAdmin->syncPermissions(Permission::all());
        $editor->syncPermissions([
            'articles.view', 'articles.create', 'articles.edit', 'articles.delete',
            'articles.submit-review', 'articles.approve', 'articles.publish',
            'categories.manage', 'tags.manage', 'media.manage', 'pages.manage',
        ]);
        $author->syncPermissions([
            'articles.view', 'articles.create', 'articles.edit', 'articles.submit-review',
        ]);
    }
}
