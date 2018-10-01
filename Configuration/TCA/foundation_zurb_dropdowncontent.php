<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_dropdown_content',
        'label' => 'title',
        'sortby' => 'sorting',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'translationSource' => 'l10n_source',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,text,files,hover,position,alignment,hover_delay,hover_panel,v_offset,h_offset,allow_overlap,allow_bottom_overlap,trap_focus,auto_focus,close_on_click,',
        'iconfile' => 'EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/dropdown.png',
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, text, files, title, text, files, hover, position, alignment, hover_delay, hover_panel, v_offset, h_offset, allow_overlap, allow_bottom_overlap, trap_focus, auto_focus, close_on_click,',
    ],
    'palettes' => [
        'dropdown_palette_0' => [
            'showitem' => '
                sys_language_uid, 
                l10n_parent, 
                l10n_diffsource, 
                hidden, 
            ',
        ],
        'dropdown_palette_2' => [
            'showitem' => '
                position, 
                alignment,
                v_offset,
                h_offset,
            ',
        ],
        'dropdown_palette_3' => [
            'showitem' => '
                hover,
                hover_panel, 
                hover_delay,
            ',
        ],
        'dropdown_palette_4' => [
            'showitem' => '
                allow_overlap, 
                allow_bottom_overlap,
                trap_focus,
                auto_focus,
                close_on_click,
            ',
        ],
        'dropdown_palette_5' => [
            'showitem' => '
                container
            ',
        ],
    ],
    'types' => [
        '1' => [
            'showitem' => '
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_dropdown_title,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_create_item;dropdown_palette_0,
                title, text, files,  
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_main,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_main;dropdown_palette_2,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_hovering;dropdown_palette_3,
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_advanced,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_advanced;dropdown_palette_4,
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
                'foreign_table' => 'foundation_zurb_dropdowncontent',
                'foreign_table_where' => 'AND foundation_zurb_dropdowncontent.pid=###CURRENT_PID### AND foundation_zurb_dropdowncontent.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_dropdown_content_title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_dropdown_content_text',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'fieldControl' => [
                    'fullScreenRichtext' => [
                        'disabled' => false,
                    ],
                ],
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ],
            
        ],
        'files' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_dropdown_content_files',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'files',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
                    ],
                    'overrideChildTca' => [
                        'types' => [
                            '0' => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                        ],
                    ],
                    'maxitems' => 999
                ]
            ),
        ],
        'hover' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_dropdown_settings_hover',
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
                'default' => 'auto',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_auto', 'auto'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_top', 'top'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_right', 'right'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_bottom', 'bottom'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_left', 'left'],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ],
        ],
        'alignment' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_alignment',
            'config' => [
                'type' => 'select',
                'default' => 'auto',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_auto', 'auto'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_top', 'top'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_right', 'right'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_bottom', 'bottom'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_left', 'left'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_center', 'center'],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ],
        ],
        'hover_panel' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_dropdown_settings_hover_panel',
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
        'hover_delay' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_hover_time_delay',
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
        'allow_overlap' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_dropdown_settings_allow_overlap',
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
        'allow_bottom_overlap' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_dropdown_settings_allow_bottom_overlap',
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
        'trap_focus' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_dropdown_settings_trap_focus',
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
        'auto_focus' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_dropdown_settings_auto_focus',
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
        'v_offset' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_v_offset',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'h_offset' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_h_offset',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'close_on_click' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_close_on_click',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.enabled'
                    ]
                ],
                'default' => 0,
            ],
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
            ],
        ],
        'tt_content' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
