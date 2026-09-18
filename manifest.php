<?php

declare(strict_types=1);

/**
 * CONTOH MANIFEST MODUL CHILD — kontrak frontend.
 *
 * 'menu'  → Sidebar (padanan add_sidebar_menu_item)
 * 'widgets' → Dashboard per area
 * 'detail_tabs' → panel detail per record (api placeholder {id})
 *
 * @return array{menu: list<array{slug: string, label: string, icon: string, href: string, position: int}>, widgets: list<array{id: string, area: string, title: string, api: string}>, detail_tabs: list<array{slug: string, label: string, icon: string, api: string, position: int}>}
 */
return [
    // Bundle frontend modul (REACT/UI) — di-import core via import(url)
    // runtime. Relatif terhadap origin backend; core me-resolve dengan
    // base URL API-nya. File diletakkan di Modules/SampleTasks/frontend/dist/
    // (hasil build paket spine-modules/sampletasks).
    'frontend' => [
        'entry_url' => '/api/v1/modules/assets/sampletasks/sampletasks.module.js',
    ],

    'menu' => [
        [
            'slug'     => 'sample-tasks',
            'label'    => 'Sample Tasks',
            'icon'     => '✅',
            'href'     => '/sample-tasks',
            'position' => 91,
        ],
    ],

    'widgets' => [
        [
            'id'    => 'sample-tasks',
            'area'  => 'right-4',
            'title' => 'Sample Tasks',
            'api'   => '/api/v1/sample-tasks',
        ],
    ],

    'detail_tabs' => [
        [
            'slug'     => 'overview',
            'label'    => 'Overview',
            'icon'     => '👁️',
            'api'      => '/api/v1/sample-tasks/{id}',
            'position' => 10,
        ],
        [
            'slug'     => 'activity',
            'label'    => 'Activity',
            'icon'     => '🕐',
            'api'      => '/api/v1/sample-tasks/{id}/activity-logs',
            'position' => 20,
        ],
    ],

    // HOOK tab lintas modul (padanan add_customer_profile_tab legacy):
    // tambahkan tab "Tasks" ke detail module Sample (target 'sample'),
    // diisi daftar child task milik SampleItem tsb (?sample_item_id={id}).
    'extend_detail_tabs' => [
        'sample' => [
            [
                'slug'     => 'tasks',
                'label'    => 'Tasks',
                'icon'     => '✅',
                'api'      => '/api/v1/sample-tasks?sample_item_id={id}',
                'position' => 30,
            ],
        ],
    ],
];
