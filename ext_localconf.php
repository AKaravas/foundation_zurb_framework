<?php
defined('TYPO3_MODE') or die();

/***************
  * Add User-TSconfig
  */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
    <INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TSconfig/User/Base.typoscript">
    [adminUser = 1]
        <INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TSconfig/User/Admin.typoscript">
    [global]
');

/***************
 * Add RTE configuration
 */
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['seitenameDefault'] = 'EXT:' . $_EXTKEY . '/Configuration/RTE/Default.yaml';

// Register for hook to show preview of tt_content element of CType="foundation_slider" in page module
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['foundation_slider'] = \Vendor\FoundationZurbFramework\Hooks\PageLayoutView\SliderPreviewRenderer::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['foundation_accordion'] = \Vendor\FoundationZurbFramework\Hooks\PageLayoutView\AccordionPreviewRenderer::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['foundation_tabs'] = \Vendor\FoundationZurbFramework\Hooks\PageLayoutView\TabsPreviewRenderer::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['foundation_reveal'] = \Vendor\FoundationZurbFramework\Hooks\PageLayoutView\RevealPreviewRenderer::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['foundation_card'] = \Vendor\FoundationZurbFramework\Hooks\PageLayoutView\CardPreviewRenderer::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['foundation_dropdown'] = \Vendor\FoundationZurbFramework\Hooks\PageLayoutView\DropdownPreviewRenderer::class;