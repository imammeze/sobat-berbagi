<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    private $permissions = [
        'dashboard',
        'dashboard-manager-campaign',
        'dashboard-mitra',
        'dashboard-direktur',
        'dashboard-finance',
        'dashboard-admin',


        'article-management',

        'article-list',
        'article-create',
        'article-edit',
        'article-delete',

        'article-category-list',
        'article-category-create',
        'article-category-edit',
        'article-category-delete',

        'article-tag-list',
        'article-tag-create',
        'article-tag-edit',
        'article-tag-delete',


        'banner-list',
        'banner-create',
        'banner-edit',
        'banner-delete',


        'campaign-management',

        'campaign-list',
        'campaign-create',
        'campaign-edit',
        'campaign-delete',
        'campaign-verify',

        'campaign-category-list',
        'campaign-category-create',
        'campaign-category-edit',
        'campaign-category-delete',

        'campaign-donation-list',
        'campaign-donation-create',
        'campaign-donation-edit',
        'campaign-donation-delete',
        'campaign-donation-approve',

        'campaign-latest-news-list',
        'campaign-latest-news-create',
        'campaign-latest-news-edit',
        'campaign-latest-news-delete',

        'contact-list',
        'contact-delete',

        'donatur-list',
        'donatur-create',
        'donatur-edit',
        'donatur-delete',


        'faq-management',

        'faq-list',
        'faq-create',
        'faq-edit',
        'faq-delete',

        'faq-category-list',
        'faq-category-create',
        'faq-category-edit',
        'faq-category-delete',


        'mitra-list',
        'mitra-create',
        'mitra-edit',
        'mitra-delete',

        'payment-method-list',
        'payment-method-create',
        'payment-method-edit',
        'payment-method-delete',

        'team-list',
        'team-create',
        'team-edit',
        'team-delete',

        'zakat-transaction-list',
        'zakat-transaction-create',
        'zakat-transaction-edit',
        'zakat-transaction-delete',
        'zakat-transaction-approve',

        'transaction-management',

        'user-management',

        'role-list',
        'role-create',
        'role-edit',
        'role-delete',

        'permission-list',
        'permission-create',
        'permission-edit',
        'permission-delete',

        'website-management',
    ];


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        Role::firstOrCreate(['name' => 'manager-campaign', 'guard_name' => 'web'])->givePermissionTo([
            'dashboard',
            'dashboard-manager-campaign',

            'campaign-management',
            'campaign-list',
            'campaign-create',
            'campaign-edit',
            'campaign-delete',
            'campaign-verify',

            'campaign-category-list',
            'campaign-category-create',
            'campaign-category-edit',
            'campaign-category-delete',

            'campaign-donation-list',
            'campaign-donation-create',
            'campaign-donation-edit',
            'campaign-donation-delete',
            'campaign-donation-approve',

            'campaign-latest-news-list',
            'campaign-latest-news-create',
            'campaign-latest-news-edit',
            'campaign-latest-news-delete',

            'mitra-list',
            'mitra-create',
            'mitra-edit',
            'mitra-delete',

            'transaction-management',

        ]);

        Role::firstOrCreate(['name' => 'mitra', 'guard_name' => 'web'])->givePermissionTo([
            'dashboard',
            'dashboard-mitra',

            'campaign-management',
            'campaign-list',
            'campaign-create',
            'campaign-edit',
            'campaign-delete',

            'campaign-donation-list',
            'campaign-donation-create',
            'campaign-donation-edit',
            'campaign-donation-delete',
            'campaign-donation-approve',

            'campaign-latest-news-list',
            'campaign-latest-news-create',
            'campaign-latest-news-edit',
            'campaign-latest-news-delete',

            'transaction-management',
        ]);

        Role::firstOrCreate([
            'name' => 'donatur',
            'guard_name' => 'web'
        ]);

        Role::firstOrCreate(['name' => 'direktur', 'guard_name' => 'web'])->givePermissionTo([
            'dashboard',
            'dashboard-direktur',

            'campaign-management',

            'campaign-list',

            'campaign-donation-list',

            'campaign-latest-news-list',

            'mitra-list',

            'donatur-list',

            'zakat-transaction-list',

            'transaction-management',
        ]);

        Role::firstOrCreate(['name' => 'finance', 'guard_name' => 'web'])->givePermissionTo([
            'dashboard',
            'dashboard-finance',

            'transaction-management',

            'zakat-transaction-list',
            'zakat-transaction-approve',

            'campaign-donation-list',
            'campaign-donation-approve',
        ]);

        Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web'])->givePermissionTo($this->permissions);
    }
}
