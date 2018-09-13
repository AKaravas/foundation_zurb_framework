<?php
if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}
 
// Configure new fields:
$magelan = array(
  'magellan_id' => array(
    'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:magellan_id',
    'exclude' => 1,
    'config' => array(
      'type' => 'input',
      'max' => 255
    ),
  ),
  'magellan_offset' => array(
    'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:magellan_offset',
    'exclude' => 1,
    'config' => array(
      'type' => 'input',
      'eval' => 'int',
      'max' => 255
    ),
  ),
  'magellan_animation_time' => array(
    'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:magellan_animation_time',
    'exclude' => 1,
    'config' => array(
      'type' => 'input',
      'eval' => 'int',
      'max' => 255
    ),
  ),
  'nav_icon' => array(
    'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:nav_icon',
    'exclude' => 1,
    'config' => array(
      'type' => 'input',
      'max' => 255
    ),
  ),
  'nav_image' => [
    'exclude' => true,
    'label' => 'LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:nav_image',
    'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
        'nav_image',
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
            'maxitems' => 1
        ]
    ),
  ],
);
 
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $magelan);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
  'pages', // Table name
  '--div--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:foundation_general, --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:magellan;magellan, --palette--;LLL:EXT:foundation_zurb_framework/Resources/Private/Language/locallang.xlf:menu_icons;menu_icons',
  '1'
);

$GLOBALS['TCA']['pages']['palettes']['magellan'] = array(
  'showitem' => 'magellan_id, magellan_offset, magellan_animation_time',
);
$GLOBALS['TCA']['pages']['palettes']['menu_icons'] = array(
  'showitem' => 'nav_icon, nav_image',
);
