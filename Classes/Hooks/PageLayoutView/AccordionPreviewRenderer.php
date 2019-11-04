<?php

namespace Karavas\FoundationZurbFramework\Hooks\PageLayoutView;

use Karavas\FoundationZurbFramework\Helper\DatabaseQueries;
use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Contains a preview rendering for the page module of CType="foundation_accordion"
 */
class AccordionPreviewRenderer implements PageLayoutViewDrawItemHookInterface
{

    /**
     * Preprocesses the preview rendering of a content element of type "Foundation Accordion"
     *
     * @param \TYPO3\CMS\Backend\View\PageLayoutView $parentObject Calling parent object
     * @param bool $drawItem Whether to draw the item using the default functionality
     * @param string $headerContent Header content
     * @param string $itemContent Item content
     * @param array $row Record row of tt_content
     *
     * @return void
     */
    public function preProcess(
        PageLayoutView &$parentObject,
        &$drawItem,
        &$headerContent,
        &$itemContent,
        array &$row
    ) {

        if ($row['CType'] === 'foundation_accordion') {

            $accordionSettings = DatabaseQueries::getTableInfosByUid('foundation_zurb_accordionsettings', $row['accordion_settings_relation'], 'uid');
            $accordionContent = DatabaseQueries::getTableInfosByUid('foundation_zurb_accordioncontent', $accordionSettings[0]['uid'], 'foundation_zurb_accordionsettings');

            $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';

            $itemContent .= '<table class="foundation_table">';
            $itemContent .= '<tbody>';
            if ($accordionSettings[0]['selected_items'] && $accordionSettings[0]['hide_settings'] != 1) {
                if (strpos($accordionSettings[0]['selected_items'], 'accordion_speed') !== false) {
                    $itemContent .= '<tr>';
                    $itemContent .= "<th>" . LocalizationUtility::translate('foundation_accordion_speed', 'FoundationZurbFramework') . "</th>";
                    $itemContent .= '<td>' . $accordionSettings[0]['accordion_speed'] . '</td>';
                    $itemContent .= '</tr>';
                }
                if (strpos($accordionSettings[0]['selected_items'], 'accordion_multiexpand') !== false) {
                    $itemContent .= '<tr>';
                    $itemContent .= "<th>" . LocalizationUtility::translate('foundation_accordion_multiexpand', 'FoundationZurbFramework') . "</th>";
                    $itemContent .= ($accordionSettings[0]['accordion_multiexpand'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                    $itemContent .= '</tr>';
                }
                if (strpos($accordionSettings[0]['selected_items'], 'accordion_all_closed') !== false) {
                    $itemContent .= '<tr>';
                    $itemContent .= "<th>" . LocalizationUtility::translate('foundation_accordion_all_closed', 'FoundationZurbFramework') . "</th>";
                    $itemContent .= ($accordionSettings[0]['accordion_all_closed'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                    $itemContent .= '</tr>';
                }
                if (strpos($accordionSettings[0]['selected_items'], 'accordion_disabled') !== false) {
                    $itemContent .= '<tr>';
                    $itemContent .= "<th>" . LocalizationUtility::translate('foundation_accordion_disabled', 'FoundationZurbFramework') . "</th>";
                    $itemContent .= ($accordionSettings[0]['accordion_disabled'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                    $itemContent .= '</tr>';
                }
            } elseif ($accordionSettings[0]['selected_items'] != 1 && $accordionSettings[0]['hide_settings'] == 1) {

            } else {
                $itemContent .= '<tr>';
                $itemContent .= "<th>" . LocalizationUtility::translate('foundation_accordion_speed', 'FoundationZurbFramework') . "</th>";
                $itemContent .= '<td>' . $accordionSettings[0]['accordion_speed'] . '</td>';
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                $itemContent .= "<th>" . LocalizationUtility::translate('foundation_accordion_multiexpand', 'FoundationZurbFramework') . "</th>";
                $itemContent .= ($accordionSettings[0]['accordion_multiexpand'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                $itemContent .= "<th>" . LocalizationUtility::translate('foundation_accordion_all_closed', 'FoundationZurbFramework') . "</th>";
                $itemContent .= ($accordionSettings[0]['accordion_all_closed'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                $itemContent .= "<th>" . LocalizationUtility::translate('foundation_accordion_disabled', 'FoundationZurbFramework') . "</th>";
                $itemContent .= ($accordionSettings[0]['accordion_disabled'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                $itemContent .= '</tr>';
            }
            $itemContent .= '</tbody>';
            $itemContent .= '</table>';

            if ($accordionSettings[0]['selected_items'] && $accordionSettings[0]['hide_content'] != 1) {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_content', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table content_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                if (strpos($accordionSettings[0]['selected_items'], 'foundation_listing') !== false) {
                    $itemContent .= '<th class="listing"></th>';
                }
                if (strpos($accordionSettings[0]['selected_items'], 'accordion_title') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_title', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($accordionSettings[0]['selected_items'], 'accordion_text') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_text', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($accordionSettings[0]['selected_items'], 'accordion_files') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_files', 'FoundationZurbFramework') . "</th>";
                }
                $itemContent .= '</tr>';
                $listNumber = 0;
                foreach (array_slice($accordionContent, 0, $accordionSettings[0]['limit_content']) as $accContent) {
                    $listNumber++;
                    if ($accContent['files'] == 1) {
                        $fileExist = 'File exists';
                    } else {
                        $fileExist = 'File does not exist';
                    }
                    $itemContent .= '<tr>';
                    if (strpos($accordionSettings[0]['selected_items'], 'foundation_listing') !== false) {
                        $itemContent .= '<td>' . $listNumber . '</td>';
                    }
                    if (strpos($accordionSettings[0]['selected_items'], 'accordion_title') !== false) {
                        $itemContent .= '<td>' . substr($accContent['title'], 0, $accordionSettings[0]['title_crop']) . '</td>';
                    }
                    if (strpos($accordionSettings[0]['selected_items'], 'accordion_text') !== false) {
                        $itemContent .= '<td>' . strip_tags(substr($accContent['text'], 0, $accordionSettings[0]['text_crop'])) . '</td>';
                    }
                    if (strpos($accordionSettings[0]['selected_items'], 'accordion_files') !== false) {
                        $itemContent .= '<td>' . $fileExist . '</td>';
                    }
                    $itemContent .= '</tr>';
                }
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            } elseif ($accordionSettings[0]['selected_items'] != 1 && $accordionSettings[0]['hide_content']) {

            } else {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_content', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table content_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                $itemContent .= '<th class="listing"></th>';
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_title', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_text', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_files', 'FoundationZurbFramework') . "</th>";
                $itemContent .= '</tr>';
                $listNumber = 0;
                $countNumber = 0;
                foreach (array_slice($accordionContent, 0, $accordionSettings[0]['limit_content']) as $accContent) {
                    $listNumber++;
                    if ($accContent['files'] == 1) {
                        $fileExist = 'File exists';
                    } else {
                        $fileExist = 'File does not exist';
                    }
                    $itemContent .= '<tr>';
                    $itemContent .= '<td>' . $listNumber . '</td>';
                    $itemContent .= '<td>' . substr($accContent['title'], 0, $accordionSettings[0]['title_crop']) . '</td>';
                    $itemContent .= '<td>' . strip_tags(substr($accContent['text'], 0, $accordionSettings[0]['text_crop'])) . '</td>';
                    $itemContent .= '<td>' . $fileExist . '</td>';
                    $itemContent .= '</tr>';
                }
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            }

            $drawItem = false;
        }
    }
}