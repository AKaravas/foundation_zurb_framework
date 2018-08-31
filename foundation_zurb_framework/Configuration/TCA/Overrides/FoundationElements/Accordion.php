<?php


/*********************************************
*                                            *
*           Foundation accordion             *
*                                            *
**********************************************/
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array('Foundation Accordion','foundation_accordion','EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/accordion.png'),'CType','foundation_zurb_framework');
// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types']['foundation_accordion'] = array(
  'showitem' => '
  --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
  --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
  --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
  --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.accordion.settings,
  --palette--;--linebreak--,accordion_settings_relation,
  --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.appearance,
  --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.frames;frames,
  --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,
  --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.visibility;visibility,
  --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.access;access,
  --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.extended',
);
$originalAccordionContent = $GLOBALS['TCA']['tt_content'];
$overridesForAccordionContent = [
  'ctrl' => [
    'typeicon_classes' => [
      'foundation_accordion' => 'Accordion',
    ]
  ]
];
$GLOBALS['TCA']['tt_content'] = array_merge_recursive($originalAccordionContent, $overridesForAccordionContent);
$foundationAccordionOptions = array( 
  'accordion_settings_relation' => [
    'exclude' => 1,
    'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.accordioncontent',
    'config' => [
      'type' => 'inline',
      'foreign_table' => 'foundation_zurb_accordionsettings',
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
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content',$foundationAccordionOptions);
 ?>