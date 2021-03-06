<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_callout_content',
        'label' => 'title',
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
        'searchFields' => 'title, text, files, size, animation_in, animation_out, color, is_closable, container, title_crop, text_crop, hide_settings, hide_content, selected_items',
        'iconfile' => 'EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/callout.png',
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, text, files, size, animation_out, color, is_closable, container, title_crop, text_crop, hide_settings, hide_content, selected_items',
    ],
    'palettes' => [
        'callout_palette_0' => [
            'showitem' => '
                sys_language_uid, 
                l10n_parent, 
                l10n_diffsource, 
                hidden, 
            ',
        ],
        'callout_palette_2' => [
            'showitem' => '
                size, 
                color, 
                animation_out,
            ',
        ],
        'callout_palette_3' => [
            'showitem' => '
                is_closable,
                container,
            ',
        ],
        'callout_palette_4' => [
            'showitem' => '
                title_crop,
                text_crop,
            ',
        ],
        'callout_palette_5' => [
            'showitem' => '
                selected_items
            ',
        ],
        'callout_palette_6' => [
            'showitem' => '
                hide_settings,
                hide_content,
            ',
        ],
    ],
    'types' => [
        '1' => [
            'showitem' => '
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_callout_title,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_create_item;callout_palette_0,
                title, text, files,  
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_main,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_main;callout_palette_2,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_main;callout_palette_3,
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_settings_backend,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_cropping;callout_palette_4,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_select_items;callout_palette_5,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_hide_items;callout_palette_6,
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
                'foreign_table' => 'foundation_zurb_callout',
                'foreign_table_where' => 'AND foundation_zurb_callout.pid=###CURRENT_PID### AND foundation_zurb_callout.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_callout_content_title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_callout_content_text',
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
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_callout_content_files',
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
        'size' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_size',
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
            ]
        ],
        'color' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_styling',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
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
        'is_closable' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_is_closable',
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
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_sizing', 'foundation_sizing' ],
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_styling', 'callout_color' ],
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_animations', 'callout_animation' ],
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_closeable', 'callout_closeable' ],
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_container', 'callout_container' ],
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_callout_content_title', 'callout_title' ],
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_callout_content_text', 'callout_text' ],
                    [ 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_callout_content_files', 'callout_files' ],
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
        'animation_out' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_animation_out',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [' ', ''],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_slide', '--div--'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_slide_out_up', 'slide-out-up'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_slide_out_right', 'slide-out-right'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_slide_out_down', 'slide-out-down'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_slide_out_left', 'slide-out-left'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_fade', '--div--'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_fade_out', 'fade-out'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_hinge', '--div--'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_hinge_out_from_top', 'hinge-out-from-top'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_hinge_out_from_right', 'hinge-out-from-right'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_hinge_out_from_bottom', 'hinge-out-from-bottom'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_hinge_out_from_left', 'hinge-out-from-left'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_hinge_out_from_middle_x', 'hinge-out-from-middle-x'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_hinge_out_from_middle_y', 'hinge-out-from-middle-y'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_scale', '--div--'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_scale_out_up', 'scale-out-up'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_scale_out_bottom', 'scale-out-down'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_spin', '--div--'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_spin_out', 'spin-out'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_spin_out_ccw', 'spin-out-ccw'],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ],
        ],
    ],
];
