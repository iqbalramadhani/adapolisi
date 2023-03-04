<?php

use App\Core\Adapters\Theme;

return array(
    'demo9-aside' => array(
        // Dashboard
        ''     => array(
            "breadcrumb-title"      => "Home",
            "icon"       => '<i class="bi bi-house fs-2"></i>',
            "attributes" => array(
                'link' => array(
                    "data-bs-trigger"   => "hover",
                    "data-bs-dismiss"   => "click",
                    "data-bs-placement" => "right",
                ),
            ),
            "classes"    => array(
                "item" => "py-2",
                "link" => "menu-center",
                "icon" => "me-0",
            ),
            "path"       => "",
        ),

        // Dashboard
        // 'user'     => array(
        //     "breadcrumb-title"      => "User",
        //     "icon"       => '<i class="bi bi-people fs-2"></i>',
        //     "attributes" => array(
        //         'link' => array(
        //             "data-bs-trigger"   => "hover",
        //             "data-bs-dismiss"   => "click",
        //             "data-bs-placement" => "right",
        //         ),
        //     ),
        //     "classes"    => array(
        //         "item" => "py-2",
        //         "link" => "menu-center",
        //         "icon" => "me-0",
        //     ),
        //     "path"       => "account/overview",
        // ),

        // Users
        'system'    => array(
            "breadcrumb-title"      => "Data Target",
            "icon"       => '<i class="bi bi-people fs-2"></i>',
            "classes"    => array(
                "item" => "py-2",
                "link" => "menu-center",
                "icon" => "me-0",
            ),
            "attributes" => array(
                "item" => array(
                    "data-kt-menu-trigger"   => "click",
                    "data-kt-menu-placement" => Theme::isRTL() ? "left-start" : "right-start",
                ),
                'link' => array(
                    "data-bs-trigger"   => "hover",
                    "data-bs-dismiss"   => "click",
                    "data-bs-placement" => "right",
                ),
            ),
            "arrow"      => false,
            "sub"        => array(
                "class" => "menu-sub-dropdown w-225px px-1 py-4",
                "items" => array(
                    array(
                        'classes' => array('content' => ''),
                        'content' => '<span class="menu-section fs-5 fw-bolder ps-1 py-1">Data Target</span>',
                    ),
                    array(
                        'title'  => 'List Data Target',
                        'path'   => 'log/system',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    )
                ),
            ),
        ),

        // Users
        'data_kasus'    => array(
            "breadcrumb-title"      => "Data Kasus",
            "icon"       => '<i class="bi bi-layers fs-2"></i>',
            "classes"    => array(
                "item" => "py-2",
                "link" => "menu-center",
                "icon" => "me-0",
            ),
            "attributes" => array(
                "item" => array(
                    "data-kt-menu-trigger"   => "click",
                    "data-kt-menu-placement" => Theme::isRTL() ? "left-start" : "right-start",
                ),
                'link' => array(
                    "data-bs-trigger"   => "hover",
                    "data-bs-dismiss"   => "click",
                    "data-bs-placement" => "right",
                ),
            ),
            "arrow"      => false,
            "sub"        => array(
                "class" => "menu-sub-dropdown w-225px px-1 py-4",
                "items" => array(
                    array(
                        'classes' => array('content' => ''),
                        'content' => '<span class="menu-section fs-5 fw-bolder ps-1 py-1">Data Kasus Ini</span>',
                    ),
                    array(
                        'title'  => 'List Data Kasus',
                        'path'   => 'data_kasus/index',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // Account
        'account'   => array(
            "breadcrumb-title"      => "Account",
            "icon"       => '<i class="bi bi-shield-check fs-2"></i>',
            "classes"    => array(
                "item" => "py-2",
                "link" => "menu-center",
                "icon" => "me-0",
            ),
            "attributes" => array(
                "item" => array(
                    "data-kt-menu-trigger"   => "click",
                    "data-kt-menu-placement" => Theme::isRTL() ? "left-start" : "right-start",
                ),
                'link' => array(
                    "data-bs-trigger"   => "hover",
                    "data-bs-dismiss"   => "click",
                    "data-bs-placement" => "right",
                ),
            ),
            "arrow"      => false,
            "sub"        => array(
                "class" => "menu-sub-dropdown w-225px px-1 py-4",
                "items" => array(
                    array(
                        'classes' => array('content' => ''),
                        'content' => '<span class="menu-section fs-5 fw-bolder ps-1 py-1">Account</span>',
                    ),
                    array(
                        'title'  => 'User dan Role',
                        'path'   => 'user_role/index',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),
    ),
);
