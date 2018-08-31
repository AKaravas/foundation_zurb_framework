<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealcontent',
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
        'searchFields' => 'title,text,files,size,no_overlay,no_animation,animation_in,animation_out,animation_speed_in,animation_speed_out,show_delay,hide_delay,close_on_click,close_on_esc,v_offset,h_offset,reset_on_close,',
        'iconfile' => 'EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/reveal.png',
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, text, files, size,no_overlay,no_animation,animation_in,animation_out,animation_speed_in,animation_speed_out, show_delay,hide_delay,close_on_click,close_on_esc,v_offset,h_offset,reset_on_close,',
    ],
    'palettes' => [
        'slider_palette_0' => [
            'showitem' => '
                sys_language_uid, 
                l10n_parent, 
                l10n_diffsource, 
                hidden, 
            ',
        ],
        'slider_palette_1' => [
            'showitem' => '
                title, 
                text, 
                files,  
            ',
        ],
        'slider_palette_2' => [
            'showitem' => '
                size, 
                no_overlay, 
                reset_on_close, 
            ',
        ],
        'slider_palette_3' => [
            'showitem' => '
                close_on_click, 
                close_on_esc,
            ',
        ],
        'slider_palette_4' => [
            'showitem' => '
                v_offset, 
                h_offset, 
            ',
        ],
        'slider_palette_5' => [
            'showitem' => '
                animation_in, 
                animation_out, 
                animation_speed_in,
                animation_speed_out,
            ',
        ],
        'slider_palette_6' => [
            'showitem' => '
                no_animation, 
                show_delay, 
                hide_delay,
            ',
        ],
    ],
    'types' => [
        '1' => [
            'showitem' => '
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.reveal.settings,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.reveal.create.item;slider_palette_0,
                title, text, files,  
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.settings.main,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.settings.main;slider_palette_2,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.reveal.settings.main.close;slider_palette_3,
            --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.settings.advanced,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.reveal.settings.main.position;slider_palette_4,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.reveal.settings.main.animations;slider_palette_5,
                --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.reveal.settings.main.no_animations;slider_palette_6,
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
                'foreign_table' => 'foundation_zurb_revealcontent',
                'foreign_table_where' => 'AND foundation_zurb_revealcontent.pid=###CURRENT_PID### AND foundation_zurb_revealcontent.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealcontent.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealcontent.text',
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
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealcontent.files',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'files',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
                    ],
                    'foreign_types' => [
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
                        ]
                    ],
                    'maxitems' => 999
                ]
            ),
        ],
        'size' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealsetting.size',
            'config' => [
                'type' => 'select',
                'default' => 'tiny',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.tiny', 'tiny'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.small', 'small'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.large', 'large'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.full', 'full'],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => '',
            ]
        ],
        'no_overlay' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealsetting.no_overlay',
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
        'no_animation' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealsetting.no_animation',
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
        'animation_in' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealsetting.animation_in',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [' ', ''],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.slide', '--div--'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.slide_in_up', 'slide-in-up'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.slide_in_right', 'slide-in-right'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.slide_in_down', 'slide-in-down'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.slide_in_left', 'slide-in-left'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.fade', '--div--'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.fade_in', 'fade-in'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.hinge', '--div--'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.hinge_in_from_top', 'hinge-in-from-top'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.hinge_in_from_right', 'hinge-in-from-right'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.hinge_in_from_bottom', 'hinge-in-from-bottom'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.hinge_in_from_left', 'hinge-in-from-left'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.hinge_in_from_middle_x', 'hinge-in-from-middle-x'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.hinge_in_from_middle_y', 'hinge-in-from-middle-y'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.scale', '--div--'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.scale_in_up', 'scale-in-up'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.scale_in_bottom', 'scale-in-down'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.spin', '--div--'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.spin_in', 'spin-in'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.spin_in_ccw', 'spin-in-ccw'],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ],
        ],
        'animation_out' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealsetting.animation_out',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [' ', ''],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.slide', '--div--'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.slide_out_up', 'slide-out-up'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.slide_out_right', 'slide-out-right'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.slide_out_down', 'slide-out-down'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.slide_out_left', 'slide-out-left'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.fade', '--div--'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.fade_out', 'fade-out'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.hinge', '--div--'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.hinge_out_from_top', 'hinge-out-from-top'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.hinge_out_from_right', 'hinge-out-from-right'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.hinge_out_from_bottom', 'hinge-out-from-bottom'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.hinge_out_from_left', 'hinge-out-from-left'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.hinge_out_from_middle_x', 'hinge-out-from-middle-x'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.hinge_out_from_middle_y', 'hinge-out-from-middle-y'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.scale', '--div--'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.scale_out_up', 'scale-out-up'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.scale_out_bottom', 'scale-out-down'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.spin', '--div--'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.spin_out', 'spin-out'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.spin_out_ccw', 'spin-out-ccw'],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ],
        ],
        'animation_speed_in' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealsetting.animation_speed_in',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [' ', ''],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.slow', 'slow'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.fast', 'fast'],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ],
        ],
        'animation_speed_out' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealsetting.animation_speed_out',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [' ', ''],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.slow', 'slow'],
                    ['LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.fast', 'fast'],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ],
        ],
        'show_delay' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealsetting.show_delay',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => '0',
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
        'hide_delay' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealsetting.hide_delay',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => '0',
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
        'close_on_click' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealsetting.close_on_click',
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
        'close_on_esc' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealsetting.close_on_esc',
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
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealsetting.v_offset',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'h_offset' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealsetting.h_offset',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'reset_on_close' => [
            'exclude' => true,
            'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.revealsetting.reset_on_close',
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
    
        'tt_content' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
