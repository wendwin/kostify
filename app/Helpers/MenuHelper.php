<?php

namespace App\Helpers;

class MenuHelper
{
    public static function getMainNavItems()
    {
        return [
            [
                'icon' => 'dashboard',
                'name' => 'Dashboard',
                'path' => '/dashboard',
            ],
            [
                'icon' => 'dashboard',
                'name' => 'Manajemen',
                'subItems' => [
                    ['name' => 'Penghuni', 'path' => '/tenants'],
                    ['name' => 'Kamar', 'path' => '/rooms'],
                ],
            ],

            [
                'icon' => 'dashboard',
                'name' => 'Transaksi',
                'subItems' => [
                    ['name' => 'Sewa', 'path' => '/sewa'],
                    ['name' => 'Tagihan', 'path' => '/tagihan'],
                    ['name' => 'Pembayaran', 'path' => '/pembayaran'],
                ],
            ],

            [
                'icon' => 'dashboard',
                'name' => 'Operasional',
                'subItems' => [
                    ['name' => 'Perawatan', 'path' => '/perawatan'],
                    ['name' => 'Pengeluaran', 'path' => '/pengeluaran'],
                ],
            ],

            [
                'icon' => 'dashboard',
                'name' => 'Laporan',
                'path' => '/laporan',
            ],
        ];
    }

    public static function getOthersItems()
    {
        return [
            [
                'icon' => 'user-profile',
                'name' => 'Pengguna',
                'path' => '/pengguna'
            ],
            // [
            //     'icon' => 'ui-elements',
            //     'name' => 'UI Elements',
            //     'subItems' => [
            //         ['name' => 'Alerts', 'path' => '/alerts', 'pro' => false],
            //         ['name' => 'Avatar', 'path' => '/avatars', 'pro' => false],
            //         ['name' => 'Badge', 'path' => '/badge', 'pro' => false],
            //         ['name' => 'Buttons', 'path' => '/buttons', 'pro' => false],
            //         ['name' => 'Images', 'path' => '/image', 'pro' => false],
            //         ['name' => 'Videos', 'path' => '/videos', 'pro' => false],
            //     ],
            // ],
            // [
            //     'icon' => 'authentication',
            //     'name' => 'Authentication',
            //     'subItems' => [
            //         ['name' => 'Sign In', 'path' => '/signin', 'pro' => false],
            //         ['name' => 'Sign Up', 'path' => '/signup', 'pro' => false],
            //     ],
            // ],
        ];
    }

    public static function getMenuGroups()
    {
        return [
            [
                'title' => 'Menu',
                'items' => self::getMainNavItems()
            ],
            [
                'title' => 'Others',
                'items' => self::getOthersItems()
            ]
        ];
    }

    public static function isActive($path)
    {
        return request()->is(ltrim($path, '/'));
    }

    public static function getIconSvg($iconName)
    {
        $icons = [
            'dashboard' => 'fa-solid fa-gauge-high',
            'tenants' => 'fa-solid fa-users',
            'room-types' => 'fa-solid fa-layer-group',
            'rooms' => 'fa-solid fa-door-open',

            'rentals' => 'fa-solid fa-file-contract',
            'bills' => 'fa-solid fa-file-invoice-dollar',
            'payments' => 'fa-solid fa-money-bill-wave',

            'maintenance' => 'fa-solid fa-screwdriver-wrench',
            'expenses' => 'fa-solid fa-receipt',

            'income' => 'fa-solid fa-chart-line',
            'expense-report' => 'fa-solid fa-money-bill-transfer',
            'arrears' => 'fa-solid fa-clock',
            'finance' => 'fa-solid fa-chart-pie',

            'users' => 'fa-solid fa-user-gear',
        ];

        return '<i class="' . ($icons[$iconName] ?? 'fa-solid fa-circle') . '"></i>';
    }
}
