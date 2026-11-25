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
            'users' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'blogs' => 'c,r,u,d',
            'pages' => 'c,r,u,d',
            'page_categories' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'contacts' => 'c,r,u,d',
            'subscribes' => 'c,r,u,d',
            'customers' => 'c,r,u,d',
            'sliders' => 'c,r,u,d',
            'videos' => 'c,r,u,d',
            'photos' => 'c,r,u,d',
            'translations' => 'c,r,u,d',
            'campaigns' => 'c,r,u,d',
            'campaign_categories' => 'c,r,u,d',
            'user_donations' => 'c,r,u,d',
        ],
        'admin' => [],
        'user' => [],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
