<?php 

#########################################
#										#										
#				Images					#
#										#
#########################################
$registerSliderImage = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$registerSliderImage->registerIcon('Slider',\TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,['source' => 'EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/slider.png']);

$registerAccordionImage = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$registerAccordionImage->registerIcon('Accordion',\TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,['source' => 'EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/accordion.png']);

$registerTabsImage = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$registerTabsImage->registerIcon('Tabs',\TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,['source' => 'EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/tabs.png']);

$registerRevealImage = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$registerRevealImage->registerIcon('Reveal',\TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,['source' => 'EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/reveal.png']);

$registerCardImage = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$registerCardImage->registerIcon('Card',\TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,['source' => 'EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/card.png']);

$registerDropdownImage = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$registerDropdownImage->registerIcon('Dropdown',\TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,['source' => 'EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/dropdown.png']);

$registerButtonImage = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$registerButtonImage->registerIcon('Button',\TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,['source' => 'EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/button.png']);

$registerGroupButtonImage = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$registerGroupButtonImage->registerIcon('GroupButton',\TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,['source' => 'EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/group_button.jpg']);

$registerGroupCalloutImage = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$registerGroupCalloutImage->registerIcon('Callout',\TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,['source' => 'EXT:foundation_zurb_framework/Resources/Public/Icons/FoundationElements/callout.png']);

#########################################
#										#
#				Help					#
#										#
#########################################

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('foundation_zurb_slidersettings', 'EXT:foundation_zurb_framework/Resources/Private/Language/locallang_csh_foundation_zurb_slidersettings.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('foundation_zurb_accordionsettings', 'EXT:foundation_zurb_framework/Resources/Private/Language/locallang_csh_foundation_zurb_accordionsettings.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('foundation_zurb_tabssettings', 'EXT:foundation_zurb_framework/Resources/Private/Language/locallang_csh_foundation_zurb_tabssettings.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('foundation_zurb_revealcontent', 'EXT:foundation_zurb_framework/Resources/Private/Language/locallang_csh_foundation_zurb_revealsettings.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('foundation_zurb_cardsettings', 'EXT:foundation_zurb_framework/Resources/Private/Language/locallang_csh_foundation_zurb_cardsettings.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('foundation_zurb_dropdowncontent', 'EXT:foundation_zurb_framework/Resources/Private/Language/locallang_csh_foundation_zurb_dropdowncontent.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('foundation_zurb_button', 'EXT:foundation_zurb_framework/Resources/Private/Language/locallang_csh_foundation_zurb_button.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('foundation_zurb_buttongroupsettings', 'EXT:foundation_zurb_framework/Resources/Private/Language/locallang_csh_foundation_zurb_buttongroupsettings.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('foundation_zurb_buttongroupcontent', 'EXT:foundation_zurb_framework/Resources/Private/Language/locallang_csh_foundation_zurb_buttongroupcontent.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('foundation_zurb_callout', 'EXT:foundation_zurb_framework/Resources/Private/Language/locallang_csh_foundation_zurb_callout.xlf');

#########################################
#										#										
#	     Allow external tables			#
#										#
#########################################

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('
			foundation_zurb_slidersettings, 
			foundation_zurb_accordionsettings, 
			foundation_zurb_accordioncontent, 
			foundation_zurb_slidercontent, 
			foundation_zurb_tabssettings, 
			foundation_zurb_tabscontent, 
			foundation_zurb_revealsettings, 
			foundation_zurb_revealcontent, 
			foundation_zurb_cardsettings, 
			foundation_zurb_cardcontent, 
			foundation_zurb_dropdowncontent, 
			foundation_zurb_button,
			foundation_zurb_buttongroupcontent,
			foundation_zurb_buttongroupsettings,
			foundation_zurb_callout
');

#########################################
#										#										
#				CSS						#
#										#
#########################################

$GLOBALS['TBE_STYLES']['stylesheet'] = 'EXT:foundation_zurb_framework/Resources/Public/Css/Backend.css';
?>