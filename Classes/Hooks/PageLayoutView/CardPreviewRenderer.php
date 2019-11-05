<?php

namespace Karavas\FoundationZurbFramework\Hooks\PageLayoutView;

use Karavas\FoundationZurbFramework\Helper\DatabaseQueries;
use Karavas\FoundationZurbFramework\Helper\Helper;
use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Contains a preview rendering for the page module of CType="foundation_card"
 */
class CardPreviewRenderer implements PageLayoutViewDrawItemHookInterface
{

    /**
     * Preprocesses the preview rendering of a content element of type "Foundation Tabs"
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

        if ($row['CType'] === 'foundation_card') {

            $cardFields = ['title', 'text', 'files', 'uid', 'card_link'];
            $cardSettings = DatabaseQueries::getTableInfosByUid('foundation_zurb_cardsettings', $row['card_settings_relation'], 'uid');
            $cardContent = DatabaseQueries::getTableInfosByUid('foundation_zurb_cardcontent', $cardSettings[0]['uid'], 'foundation_zurb_cardsettings', $cardFields);

            $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
            $itemContent .= '<table class="foundation_table">';
            $itemContent .= '<tbody>';
            if ($cardSettings[0]['selected_items'] && $cardSettings[0]['hide_settings'] != 1) {
                if (strpos($cardSettings[0]['selected_items'], 'items_on_small') !== false) {
                    $itemContent .= '<tr>';
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_card_small_items', 'FoundationZurbFramework') . "</th>";
                    $itemContent .= '<td>' . $cardSettings[0]['small_items'] . '</td>';
                    $itemContent .= '</tr>';
                }
                if (strpos($cardSettings[0]['selected_items'], 'items_on_medium') !== false) {
                    $itemContent .= '<tr>';
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_card_medium_items', 'FoundationZurbFramework') . "</th>";
                    $itemContent .= '<td>' . $cardSettings[0]['medium_items'] . '</td>';
                    $itemContent .= '</tr>';
                }
                if (strpos($cardSettings[0]['selected_items'], 'items_on_large') !== false) {
                    $itemContent .= '<tr>';
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_card_large_items', 'FoundationZurbFramework') . "</th>";
                    $itemContent .= '<td>' . $cardSettings[0]['large_items'] . '</td>';
                    $itemContent .= '</tr>';
                }
            } elseif ($cardSettings[0]['selected_items'] != 1 && $cardSettings[0]['hide_settings']) {

            } else {
                $itemContent .= '<tr>';
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_card_small_items', 'FoundationZurbFramework') . "</th>";
                $itemContent .= '<td>' . $cardSettings[0]['small_items'] . '</td>';
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_card_medium_items', 'FoundationZurbFramework') . "</th>";
                $itemContent .= '<td>' . $cardSettings[0]['medium_items'] . '</td>';
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_card_large_items', 'FoundationZurbFramework') . "</th>";
                $itemContent .= '<td>' . $cardSettings[0]['large_items'] . '</td>';
                $itemContent .= '</tr>';
            }
            $itemContent .= '</tbody>';
            $itemContent .= '</table>';

            if ($cardSettings[0]['selected_items'] && $cardSettings[0]['hide_advanced'] != 1) {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_card_content_container', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                if (strpos($cardSettings[0]['selected_items'], 'card_container') !== false) {
                    $itemContent .= "<th>" . LocalizationUtility::translate('foundation_use_container', 'FoundationZurbFramework') . "</th>";
                    $itemContent .= ($cardSettings[0]['use_container'] === 1 ? '<td> &#10004;</td></tr>' : '<td> &#10008;</td>');
                }
                $itemContent .= '</tr>';
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            } elseif ($cardSettings[0]['selected_items'] != 1 && $cardSettings[0]['hide_advanced']) {

            } else {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_card_content_container', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                $itemContent .= "<th>" . LocalizationUtility::translate('foundation_use_container', 'FoundationZurbFramework') . "</th>";
                $itemContent .= ($cardSettings[0]['use_container'] === 1 ? '<td> &#10004;</td></tr>' : '<td> &#10008;</td>');
                $itemContent .= '</tr>';
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            }

            if ($cardSettings[0]['selected_items'] && $cardSettings[0]['hide_content'] != 1) {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_content', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table content_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                if (strpos($cardSettings[0]['selected_items'], 'foundation_listing') !== false) {
                    $itemContent .= '<th class="listing"></th>';
                }
                if (strpos($cardSettings[0]['selected_items'], 'card_title') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_title', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($cardSettings[0]['selected_items'], 'card_text') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_text', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($cardSettings[0]['selected_items'], 'card_link') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_link', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($cardSettings[0]['selected_items'], 'card_files') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_files', 'FoundationZurbFramework') . "</th>";
                }
                $itemContent .= '</tr>';
                $listNumber = 0;
                foreach (array_slice($cardContent, 0, $cardSettings[0]['limit_content']) as $caContent) {
                    $listNumber++;
                    if ($caContent['files'] == 1) {
                        $fileExist = 'File exists';
                    } else {
                        $fileExist = 'File does not exist';
                    }
                    $itemContent .= '<tr>';
                    if (strpos($cardSettings[0]['selected_items'], 'foundation_listing') !== false) {
                        $itemContent .= '<td>' . $listNumber . '</td>';
                    }
                    if (strpos($cardSettings[0]['selected_items'], 'card_title') !== false) {
                        $itemContent .= '<td>' . substr($caContent['title'], 0, $cardSettings[0]['title_crop']) . '</td>';
                    }
                    if (strpos($cardSettings[0]['selected_items'], 'card_text') !== false) {
                        $itemContent .= '<td>' . strip_tags(substr($caContent['text'], 0, $cardSettings[0]['text_crop'])) . '</td>';
                    }
                    if (strpos($cardSettings[0]['selected_items'], 'card_link') !== false) {
                        $itemContent .=  Helper::createLink($caContent['card_link'],  $cardSettings[0]['link_crop']);
                    }
                    if (strpos($cardSettings[0]['selected_items'], 'card_files') !== false) {
                        $itemContent .= '<td>' . $fileExist . '</td>';
                    }
                    $itemContent .= '</tr>';
                }
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            } elseif ($cardSettings[0]['selected_items'] != 1 && $cardSettings[0]['hide_content']) {

            } else {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_content', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table content_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                $itemContent .= '<th class="listing"></th>';
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_title', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_text', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_link', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_files', 'FoundationZurbFramework') . "</th>";
                $itemContent .= '</tr>';
                $listNumber = 0;
                foreach (array_slice($cardContent, 0, $cardSettings[0]['limit_content']) as $caContent) {
                    $listNumber++;
                    if ($caContent['files'] == 1) {
                        $fileExist = 'File exists';
                    } else {
                        $fileExist = 'File does not exist';
                    }
                    $itemContent .= '<tr>';
                    $itemContent .= '<td>' . $listNumber . '</td>';
                    $itemContent .= '<td>' . substr($caContent['title'], 0, $cardSettings[0]['title_crop']) . '</td>';
                    $itemContent .= '<td>' . strip_tags(substr($caContent['text'], 0, $cardSettings[0]['text_crop'])) . '</td>';
                    $itemContent .= Helper::createLink($caContent['card_link'],  $cardSettings[0]['link_crop']);
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