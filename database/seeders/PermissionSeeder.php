<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

//            ---------------------- admin Permissions Start------------------------
            ['name' => 'admin_user-management_module-list', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_module-create', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_module-show', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_module-edit', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_module-delete', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_module-activity-log', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_module-activity-log-trash', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_permission-group-list', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_permission-group-create', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_permission-group-show', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_permission-group-edit', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_permission-group-activity-log', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_permission-group-activity-log-trash', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_permission-group-delete', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_permission-list', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_permission-create', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_permission-show', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_permission-edit', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_permission-delete', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_role-list', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_role-create', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_role-show', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_role-edit', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_role-delete', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_user-list', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_user-create', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_user-show', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_user-edit', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_user-activity-log', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_user-activity-log-trash', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_user-delete', 'group_id' => 1, 'module_id' => 1],
            ['name' => 'admin_user-management_backup-list', 'group_id' => 2, 'module_id' => 1],
            ['name' => 'admin_user-management_backup-create', 'group_id' => 2, 'module_id' => 1],
            ['name' => 'admin_user-management_backup-download', 'group_id' => 2, 'module_id' => 1],
            ['name' => 'admin_user-management_backup-delete', 'group_id' => 2, 'module_id' => 1],
            ['name' => 'admin_user-management_log-dashboard', 'group_id' => 2, 'module_id' => 1],
            ['name' => 'admin_user-management_log-list', 'group_id' => 2, 'module_id' => 1],
            ['name' => 'admin_user-management_log-show', 'group_id' => 2, 'module_id' => 1],
            ['name' => 'admin_user-management_log-download', 'group_id' => 2, 'module_id' => 1],
            ['name' => 'admin_user-management_log-delete', 'group_id' => 2, 'module_id' => 1],
//            ---------------------- admin Permissions End------------------------

//            ---------------------- Manager Permissions Start------------------------
//            session permission
            ['name' => 'manager_master-data_session-list', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_session-edit', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_session-status-edit', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_session-create', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_session-show', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_session-delete', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_session-activity-log-trash', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_session-activity-log', 'group_id' => 3, 'module_id' => 2],
//            registration-type permission
            ['name' => 'manager_master-data_registration-type-list', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_registration-type-edit', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_registration-type-show', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_registration-type-create', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_registration-type-delete', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_registration-type-activity-log-trash', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_registration-type-activity-log', 'group_id' => 3, 'module_id' => 2],
//            payment-type permission
            ['name' => 'manager_master-data_payment-type-list', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_payment-type-edit', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_payment-type-show', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_payment-type-create', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_payment-type-delete', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_payment-type-activity-log-trash', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_payment-type-activity-log', 'group_id' => 3, 'module_id' => 2],
//            registration-status permission
            ['name' => 'manager_master-data_registration-status-list', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_registration-status-edit', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_registration-status-status-edit', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_registration-status-show', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_registration-status-create', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_registration-status-delete', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_registration-status-activity-log-trash', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_master-data_registration-status-activity-log', 'group_id' => 3, 'module_id' => 2],
//            user-registration permission
            ['name' => 'manager_registration_user-registration-list', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_user-registration-edit', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_user-registration-show', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_user-registration-create', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_user-registration-delete', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_user-registration-activity-log-trash', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_user-registration-activity-log', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_user-registration-voucher-download', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_user-registration-voucher-upload', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_user-registration-voucher-view', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_user-registration-gate-pass-download', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_user-registration-certificate-download', 'group_id' => 5, 'module_id' => 2],

//            abstract-submission permission
            ['name' => 'manager_registration_abstract-submission-list', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_abstract-submission-edit', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_abstract-submission-status-edit', 'group_id' => 3, 'module_id' => 2],
            ['name' => 'manager_registration_abstract-submission-show', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_abstract-submission-create', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_abstract-submission-delete', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_abstract-submission-activity-log-trash', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_abstract-submission-activity-log', 'group_id' => 5, 'module_id' => 2],
            ['name' => 'manager_registration_abstract-submission-submission', 'group_id' => 5, 'module_id' => 2],
//            ---------------------- Manager Permissions End------------------------


//            ---------------------- User Permissions Start------------------------
            ['name' => 'user_registration_user-registration-list', 'group_id' => 5, 'module_id' => 3],
            ['name' => 'user_registration_abstract-submission-list', 'group_id' => 5, 'module_id' => 3],
            ['name' => 'user_registration_abstract-submission-activity-log', 'group_id' => 5, 'module_id' => 3],
            ['name' => 'user_registration_abstract-submission-create', 'group_id' => 5, 'module_id' => 3],
            ['name' => 'user_registration_abstract-submission-show', 'group_id' => 5, 'module_id' => 3],
            ['name' => 'user_registration_abstract-submission-edit', 'group_id' => 5, 'module_id' => 3],
            ['name' => 'user_registration_abstract-submission-delete', 'group_id' => 5, 'module_id' => 3],
//            ---------------------- Manager Permissions End------------------------

        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
