<?php


/******************************************
*                                         *
*           Foundation Dropdown           *
*                                         *
*******************************************/
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array('Foundation Dropdown','foundation_dropdown','EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/dropdown.png'),'CType','foundation_zurb_framework');
// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types']['foundation_dropdown'] = array(
  'showitem' => '
  --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
  --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
  --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
  --div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_dropdown_title,
  --palette--;--linebreak--,dropdown_content_relation,
  --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.appearance,
  --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.frames;frames,
  --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,
  --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.visibility;visibility,
  --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.access;access,
  --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.extended',
);
$originalDropdownContent = $GLOBALS['TCA']['tt_content'];
$overridesForDropdownContent = [
  'ctrl' => [
    'typeicon_classes' => [
      'foundation_dropdown' => 'Dropdown',
    ]
  ]
];
$GLOBALS['TCA']['tt_content'] = array_merge_recursive($originalDropdownContent, $overridesForDropdownContent);
$foundationDropdownOptions = array( 
  'dropdown_content_relation' => [
    'exclude' => 1,
    'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_dropdown_description',
    'config' => [
      'type' => 'inline',
      'foreign_table' => 'foundation_zurb_dropdowncontent',
      'foreign_field' => 'tt_content',
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
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content',$foundationDropdownOptions);
 ?>