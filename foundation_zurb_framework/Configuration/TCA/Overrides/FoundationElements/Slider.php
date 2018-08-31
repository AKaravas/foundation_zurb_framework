<?php


/******************************************
*                                         *
*           Foundation Slider             *
*                                         *
*******************************************/
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array('Foundation Slider','foundation_slider','EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/slider.png'),'CType','foundation_zurb_framework');
// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types']['foundation_slider'] = array(
  'showitem' => '
  --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
  --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
  --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
  --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.slider.settings,
  --palette--;--linebreak--,slider_settings_relation,
  --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.appearance,
  --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.frames;frames,
  --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,
  --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.visibility;visibility,
  --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.access;access,
  --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.extended',
);
$originalSliderContent = $GLOBALS['TCA']['tt_content'];
$overridesForSliderContent = [
  'ctrl' => [
    'typeicon_classes' => [
      'foundation_slider' => 'Slider',
    ]
  ]
];
$GLOBALS['TCA']['tt_content'] = array_merge_recursive($originalSliderContent, $overridesForSliderContent);
$foundationSliderOptions = array( 
  'slider_settings_relation' => [
    'exclude' => 1,
    'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation.slider.description',
    'config' => [
      'type' => 'inline',
      'foreign_table' => 'foundation_zurb_slidersettings',
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
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content',$foundationSliderOptions);
 ?>