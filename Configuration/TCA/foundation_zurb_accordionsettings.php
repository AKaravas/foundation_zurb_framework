<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_accordion_title',
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
        'searchFields' => 'title,accordion_speed,accordion_multiexpand,accordion_all_closed,accordion_disabled,accordion_content_relation, title_crop, text_crop, hide_settings, hide_content, selected_items',
        'iconfile' => 'EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/accordion.png'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, accordion_speed, accordion_multiexpand, accordion_all_closed, accordion_disabled, accordion_content_relation, title_crop, text_crop, hide_settings, hide_content, selected_items',
    ],
    'palettes' => [
        'accordion_palette_0' => [
            'showitem' => '
            sys_language_uid, 
            l10n_parent, 
            l10n_diffsource, 
            hidden, 
            ',
        ],
        'accordion_palette_1' => [
            'showitem' => '
            accordion_content_relation,
            ',
        ],
        'accordion_palette_2' => [
            'showitem' => '
            accordion_multiexpand, accordion_all_closed, accordion_disabled,
            ',
        ],
        'accordion_palette_3' => [
            'showitem' => '
            accordion_speed,
            ',
        ],
        'accordion_palette_4' => [
            'showitem' => '
                title_crop,
                text_crop,
            ',
        ],
        'accordion_palette_5' => [
            'showitem' => '
                selected_items
            ',
        ],
        'accordion_palette_6' => [
            'showitem' => '
                hide_settings, 
                hide_content
            ',
        ],
    ],
    'types' => [
        '1' => [
            'showitem' => '
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_accordion_title,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_create_item;accordion_palette_0,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_create_accordion;accordion_palette_1,
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_main,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_main;accordion_palette_2,
                --palette--;;accordion_palette_3,
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_backend,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_cropping;accordion_palette_4,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_select_items;accordion_palette_5,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_hide_items;accordion_palette_6,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime
        '],
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
                'foreign_table' => 'foundation_zurb_accordionsettings',
                'foreign_table_where' => 'AND foundation_zurb_accordionsettings.pid=###CURRENT_PID### AND foundation_zurb_accordionsettings.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_accordion_title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'accordion_speed' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_accordion_speed',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => '250',
                'valuePicker' => [
                    'items' => [
                        [ '100', '100', ],
                        [ '350', '350', ],
                        [ '500', '500', ],
                        [ '1000', '1000', ],
                    ],
                ],
            ],
        ],
        'accordion_multiexpand' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_accordion_multiexpand',
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
        'accordion_all_closed' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_accordion_all_closed',
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
        'accordion_disabled' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_accordion_disabled',
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
        'title_crop' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_title_crop',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => '30',
                'valuePicker' => [
                    'items' => [
                        [ '10', '10', ],
                        [ '20', '20', ],
                        [ '30', '30', ],
                        [ '40', '40', ],
                        [ '50', '50', ],
                    ],
                ],
            ]
        ],
        'text_crop' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_text_crop',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => '30',
                'valuePicker' => [
                    'items' => [
                        [ '10', '10', ],
                        [ '20', '20', ],
                        [ '30', '30', ],
                        [ '40', '40', ],
                        [ '50', '50', ],
                    ],
                ],
            ]
        ],
        'selected_items' => [
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:selected_items',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'items' => [
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_accordion_speed', 'accordion_speed' ],
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_accordion_multiexpand', 'accordion_multiexpand' ],
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_accordion_all_closed', 'accordion_all_closed' ],
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_accordion_disabled', 'accordion_disabled' ],
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_listing', 'foundation_listing' ],
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_accordion_content_title', 'accordion_title' ],
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_accordion_content_text', 'accordion_text' ],
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_accordion_content_files', 'accordion_files' ],
                ],
            ],
        ],
        'hide_settings' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_hide_settings',
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
        'hide_content' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_hide_content',
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
        'accordion_content_relation' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_create_item',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'foundation_zurb_accordioncontent',
                'foreign_field' => 'foundation_zurb_accordionsettings',
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
