<?php


/******************************************
*                                         *
*           Foundation Button             *
*                                         *
*******************************************/
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array('Foundation Callout','foundation_callout','EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/callout.png'),'CType','foundation_zurb_framework');
// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types']['foundation_callout'] = array(
  'showitem' => '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
    --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_callout_title,
    --palette--;--linebreak--,callout_content_relation,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.appearance,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.frames;frames,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.visibility;visibility,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.access;access,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.extended',
);
$originalCalloutContent = $GLOBALS['TCA']['tt_content'];
$overridesForCalloutContent = [
  'ctrl' => [
    'typeicon_classes' => [
      'foundation_callout' => 'Callout',
    ]
  ]
];
$GLOBALS['TCA']['tt_content'] = array_merge_recursive($originalCalloutContent, $overridesForCalloutContent);
$foundationCalloutOptions = array( 
  'callout_content_relation' => [
    'exclude' => 1,
    'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_callout_description',
    'config' => [
      'type' => 'inline',
      'foreign_table' => 'foundation_zurb_callout',
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
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content',$foundationCalloutOptions);
 ?>