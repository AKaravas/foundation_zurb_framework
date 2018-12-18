<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_tabs_title',
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
        'searchFields' => 'title,vertical_tabs,collapse_tabs,deep_linking, title_crop, text_crop',
        'iconfile' => 'EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/tabs.png'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, vertical_tabs, collapse_tabs, deep_linking, tabs_content_relation, title_crop, text_crop',
    ],
    'palettes' => [
        'tabs_palette_0' => [
            'showitem' => '
                sys_language_uid, 
                l10n_parent, 
                l10n_diffsource, 
                hidden, 
            ',
        ],
        'tabs_palette_1' => [
            'showitem' => '
                tabs_content_relation,
            ',
        ],
        'tabs_palette_2' => [
            'showitem' => '
                vertical_tabs, 
                collapse_tabs, 
                deep_linking,
            ',
        ],
        'tabs_palette_3' => [
            'showitem' => '
                title_crop,
                text_crop
            ',
        ],
    ],
    'types' => [
        '1' => [
            'showitem' => '
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_tabs_title,
            --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_create_item;tabs_palette_0,
            --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_create_tab;tabs_palette_1,
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_main,
            --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_main;tabs_palette_2,
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_backend,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_cropping;tabs_palette_3,
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
                'foreign_table' => 'foundation_zurb_tabssettings',
                'foreign_table_where' => 'AND foundation_zurb_tabssettings.pid=###CURRENT_PID### AND foundation_zurb_tabssettings.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_tabs.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'vertical_tabs' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_tabs_vertical',
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
        'collapse_tabs' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_tabs_collapse',
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
        'deep_linking' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_deep_link',
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
        'tabs_content_relation' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_tabs_content_relation',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'foundation_zurb_tabscontent',
                'foreign_field' => 'foundation_zurb_tabssettings',
                'maxitems' => 999,
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
