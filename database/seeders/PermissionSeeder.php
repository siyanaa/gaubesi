<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'create_users',
            'view_users',
            'update_users',
            'delete_users',
            'create_roles',
            'view_roles',
            'update_roles',
            'delete_roles',
            'create_permissions',
            'view_permissions',
            'update_permissions',
            'delete_permissions',
            'view_history',
            'permanent_delete_users',
            'restore_users',
            'view_deleted_users',
            'can_register',
            'create_about_description',
            'view_about_description',
            'update_about_description',
            'delete_about_description',
            'create_aboutus',
            'view_aboutus',
            'update_aboutus',
            'delete_aboutus',
            'create_blogs',
            'view_blogs',
            'update_blogs',
            'delete_blogs',
            'create_categories',
            'view_categories',
            'update_categories',
            'delete_categories',
            'create_subcatergories',
            'create_faqs',
            'view_faqs',
            'update_faqs',
            'delete_faqs',
            'create_favicon',
            'view_favicon',
            'update_favicon',
            'delete_favicon',
            'create_metadata',
            'view_metadata',
            'update_metadata',
            'delete_metadata',
            'create_property',
            'view_property',
            'update_property',
            'delete_property',
            'create_services',
            'view_services',
            'update_services',
            'delete_services',
            'create_sitesetting',
            'view_sitesetting',
            'update_sitesetting',
            'delete_sitesetting',
            'create_sociallinks',
            'view_sociallinks',
            'update_sociallinks',
            'delete_sociallinks',
            'create_testimonials',
            'view_testimonials',
            'update_testimonials',
            'edit_testimonials',
            'delete_testimonials',
            'create_team',
            'view_team',
            'update_team',
            'delete_team',
        ];
        
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }
    }
}
