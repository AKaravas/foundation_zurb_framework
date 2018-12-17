<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_group_button_title',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title, size, color, stacked, expanded, container',
        'iconfile' => 'EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/group_button.jpg'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, size, color, stacked, expanded, position, container, buttongroup_content_relation',
    ],
    'palettes' => [
        'group_button_palette_0' => [
            'showitem' => '
                sys_language_uid, 
                l10n_parent, 
                l10n_diffsource, 
                hidden, 
            ',
        ],
        'group_button_palette_1' => [
            'showitem' => '
                buttongroup_content_relation,
            ',
        ],
        'group_button_palette_2' => [
            'showitem' => '
                size, 
                color, 
                stacked, 
                expanded,
            ',
        ],
        'group_button_palette_3' => [
            'showitem' => '
                container,
                position,
            ',
        ],
    ],
    'types' => [
        '1' => [
            'showitem' => '
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_group_button_title,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_create_item;group_button_palette_0,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_create_buttongroup;group_button_palette_1,
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_main,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_main;group_button_palette_2,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_container;group_button_palette_3,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'foundation_zurb_buttongroupsettings',
                'foreign_table_where' => 'AND foundation_zurb_buttongroupsettings.pid=###CURRENT_PID### AND foundation_zurb_buttongroupsettings.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
            ],
        ],
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_group_buttons_title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'size' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_sizing',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', ''],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_sizing_tiny', 'tiny'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_sizing_small', 'small'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_sizing_large', 'large'],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => '',
            ],
        ],
        'color' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_styling',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_styling_not_defined', 'undefined'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_styling_primary', 'primary'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_styling_secondary', 'secondary'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_styling_success', 'success'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_styling_alert', 'alert'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_styling_warning', 'warning'],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => '',
            ],
        ],
        'stacked' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_stacked',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', ''],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_stacked_all', 'stacked'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_stacked_for_small', 'stacked-for-small'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_stacked_for_medium', 'stacked-for-medium'],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => '',
            ],
        ],
        'expanded' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_resizing_expanded',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.enabled'
                    ]
                ],
                'default' => 0,
            ]
        ],
        'container' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_container',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.enabled'
                    ]
                ],
                'default' => 0,
            ]
        ],
        'position' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_position',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', ''],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_align_center', 'align-center'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_align_right', 'align-right'],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => '',
            ],
        ],
        'buttongroup_content_relation' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_create_item',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'foundation_zurb_buttongroupcontent',
                'foreign_field' => 'foundation_zurb_buttongroupsettings',
                'maxitems' => 9999,
                'appearance' => [
                    'useSortable' => 1,
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'bottom',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1,
                    'enabledControls' => [
                        'info' => TRUE,
                        'new' => TRUE,
                        'dragdrop' => TRUE,
                        'sort' => TRUE,
                        'hide' => TRUE,
                        'delete' => TRUE,
                        'localize' => TRUE,
                    ],
                ],
            ],

        ],
    ]
];
