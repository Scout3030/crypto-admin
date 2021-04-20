<?php

namespace Database\Seeders;

use App\Helpers\Roles;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::upsert([
            ['name' => 'role-list'],
            ['name' => 'role-edit'],
            ['name' => 'role-create'],
            ['name' => 'role-delete'],
            ['name' => 'dashboard-transactions-chart'],
            ['name' => 'show_dashboard_active_merchants'],
            ['name' => 'show_dashboard_latest_transactions'],
            ['name' => 'show_dashboard_latest_tickets'],
            ['name' => 'show_dashboard_latest_emails-list'],
            ['name' => 'show_dashboard_latest_refund'],
            ['name' => 'show_dashboard_latest_chargebacks'],
            ['name' => 'admin-role-side-menu'],
            ['name' => 'admin-side-menu'],
            ['name' => 'mid-details-side-menu'],
            ['name' => 'merchant-management'],
            ['name' => 'user-management-side-menu'],
            ['name' => 'transactions-side-menu'],
            ['name' => 'refund-side-menu'],
            ['name' => 'chargebacks-side-menu'],
            ['name' => 'report-by-mid'],
            ['name' => 'report-by-transaction-type'],
            ['name' => 'transaction-summary-report'],
            ['name' => 'download-payout-reports'],
            ['name' => 'generate-payout-reports'],
            ['name' => 'download-excel-reports'],
            ['name' => 'payout-summary-report'],
            ['name' => 'payout-schedule'],
            ['name' => 'agent-reports'],
            ['name' => 'api-key-approve'],
            ['name' => 'iframe-generator'],
            ['name' => 'tutorials'],
            ['name' => 'tickets-module'],
            ['name' => 'create-merchant'],
            ['name' => 'export-excel-button-all'],
            ['name' => 'show-merchant'],
            ['name' => 'edit-merchant'],
            ['name' => 'delete-merchant'],
            ['name' => 'merchant-users-actions-button'],
            ['name' => 'transactions-action'],
            ['name' => 'export-excel-button-all'],
            ['name' => 'transactions-cardno-cvv'],
            ['name' => 'report-generate'],
            ['name' => 'report-action'],
            ['name' => 'user-ban-refund'],
            ['name' => 'user-ban-refund'],
            ['name' => 'transaction-session-data'],
        ], ['name']);

        try {
            $root = Role::whereName(Role::ROLE_NAME_ROOT)->firstOrFail();
            $permissions = Permission::all();
            $root->permissions()->attach($permissions);
            User::where('role', Roles::ROOT)->update(['role_id' => $root->id]);
        } catch (ModelNotFoundException $exception) {
        }
    }
}
