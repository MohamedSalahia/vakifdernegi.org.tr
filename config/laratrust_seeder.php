<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'roles' => 'c,r,u,d',
            'admins' => 'c,r,u,d',
            'plans' => 'c,r,u,d',
            'features' => 'c,r,u,d',
            'tenants' => 'c,r,u,d',
            'nationalities' => 'c,r,u,d',
            'currencies' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'countries' => 'c,r,u,d',
            'governorates' => 'c,r,u,d',
            'areas' => 'c,r,u,d',
        ],
        'admin' => [],
        'user' => [
            'profile' => 'r,u',
        ],
        'role_name' => [
            'module_1_name' => 'c,r,u,d',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
