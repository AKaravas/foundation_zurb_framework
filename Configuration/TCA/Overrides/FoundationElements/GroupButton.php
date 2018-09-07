<?php


/******************************************
*                                         *
*        Foundation Group button          *
*                                         *
*******************************************/
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array('Foundation Button Group','foundation_group_button','EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/group_button.jpg'),'CType','foundation_zurb_framework');
// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types']['foundation_group_button'] = array(
  'showitem' => '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
    --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_group_button_title,
    --palette--;--linebreak--,buttongroup_settings_relation,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.appearance,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.frames;frames,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.visibility;visibility,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.access;access,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.extended',
);
$originalButtonGroupContent = $GLOBALS['TCA']['tt_content'];
$overridesForButtonGroupContent = [
  'ctrl' => [
    'typeicon_classes' => [
      'foundation_group_button' => 'GroupButton',
    ]
  ]
];
$GLOBALS['TCA']['tt_content'] = array_merge_recursive($originalButtonGroupContent, $overridesForButtonGroupContent);
$foundationButtonGroupOptions = array( 
  'buttongroup_settings_relation' => [
    'exclude' => 1,
    'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_group_button_description',
    'config' => [
      'type' => 'inline',
      'foreign_table' => 'foundation_zurb_buttongroupsettings',
      'maxitems' => 1,
      'appearance' => [
          'collapseAll' => 0,
          'levelLinksPosition' => 'top',
          'showSynchronizationLink' => 1,
          'showPossibleLocalizationRecords' => 1,
          'showAllLocalizationLink' => 1
      ],
    ],
  ],
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content',$foundationButtonGroupOptions);
 ?>