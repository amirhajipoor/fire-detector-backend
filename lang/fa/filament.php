<?php

return [
    'resources' => [
        'reports' => [
            'label' => 'گزارش',
            'plural_label' => 'گزارش‌ها',
            'fields' => [
                'user_id' => 'کاربر',
                'value' => 'مقدار گاز',
                'reported_at' => 'تاریخ گزارش',
                'comment' => 'کامنت',
                'level' => 'سطح هشدار',
            ],
        ],

        'users' => [
            'label' => 'کاربر',
            'plural_label' => 'کاربران',
            'fields' => [
                'name' => 'نام',
                'mobile' => 'شماره موبایل',
                'email' => 'ایمیل',
                'token' => 'توکن',
                'password' => 'رمز عبور',
                'created_at' => 'تاریخ ایجاد',
                'updated_at' => 'آخرین ویرایش',
            ],
        ],
    ],
];
