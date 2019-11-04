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
class ButtonPreviewRenderer implements PageLayoutViewDrawItemHookInterface
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


        if ($row['CType'] === 'foundation_button') {

            $buttonSettings = DatabaseQueries::getTableInfosByUid('foundation_zurb_button', $row['button_content_relation'], 'uid');

            $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';

            $itemContent .= '<table class="foundation_table one_table">';
            $itemContent .= '<tbody>';
            if ($buttonSettings[0]['selected_items'] && $buttonSettings[0]['hide_settings'] != 1) {
                $itemContent .= '<tr>';
                if (strpos($buttonSettings[0]['selected_items'], 'foundation_sizing') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_size', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($buttonSettings[0]['selected_items'], 'button_color') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_color', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($buttonSettings[0]['selected_items'], 'button_hollow') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_styling_hollow', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($buttonSettings[0]['selected_items'], 'button_clear') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_styling_clear', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($buttonSettings[0]['selected_items'], 'button_disabled') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_disabled', 'FoundationZurbFramework') . "</th>";
                }
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                if (strpos($buttonSettings[0]['selected_items'], 'foundation_sizing') !== false) {
                    $itemContent .= (empty($buttonSettings[0]['size']) ? '<td>Normal</td>' : '<td>' . $buttonSettings[0]['size'] . '</td>');
                }
                if (strpos($buttonSettings[0]['selected_items'], 'button_color') !== false) {
                    $itemContent .= '<td> ' . $buttonSettings[0]['color'] . '</td>';
                }
                if (strpos($buttonSettings[0]['selected_items'], 'button_hollow') !== false) {
                    $itemContent .= ($buttonSettings[0]['hollow'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                }
                if (strpos($buttonSettings[0]['selected_items'], 'button_clear') !== false) {
                    $itemContent .= ($buttonSettings[0]['clear'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                }
                if (strpos($buttonSettings[0]['selected_items'], 'button_disabled') !== false) {
                    $itemContent .= ($buttonSettings[0]['disabled'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                }
                $itemContent .= '</tr>';
            } elseif ($buttonSettings[0]['selected_items'] != 1 && $buttonSettings[0]['hide_settings'] == 1) {

            } else {
                $itemContent .= '<tr>';
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_size', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_color', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_styling_hollow', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_styling_clear', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_disabled', 'FoundationZurbFramework') . "</th>";
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                $itemContent .= (empty($buttonSettings[0]['size']) ? '<td>Normal</td>' : '<td>' . $buttonSettings[0]['size'] . '</td>');
                $itemContent .= '<td> ' . $buttonSettings[0]['color'] . '</td>';
                $itemContent .= ($buttonSettings[0]['hollow'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                $itemContent .= ($buttonSettings[0]['clear'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                $itemContent .= ($buttonSettings[0]['disabled'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                $itemContent .= '</tr>';
            }
            $itemContent .= '</tbody>';
            $itemContent .= '</table>';


            if ($buttonSettings[0]['selected_items'] && $buttonSettings[0]['hide_advanced'] != 1) {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_advanced', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                if (strpos($buttonSettings[0]['selected_items'], 'button_container') !== false) {
                    $itemContent .=  "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_container', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($buttonSettings[0]['selected_items'], 'button_position') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_alignment', 'FoundationZurbFramework') . "</th>";
                }
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                if (strpos($buttonSettings[0]['selected_items'], 'button_container') !== false) {
                    $itemContent .= ($buttonSettings[0]['container'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                }
                if (strpos($buttonSettings[0]['selected_items'], 'button_position') !== false) {
                    $itemContent .= ($buttonSettings[0]['container'] != 1 ? "<td>" . LocalizationUtility::translate('foundation_container_disabled', 'FoundationZurbFramework') . "</td>" : ($buttonSettings[0]['position'] === '' ? '<td> align-left</td>' : '<td>' . $buttonSettings[0]['position'] . '</td>'));
                }
                $itemContent .= '</tr>';
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            } elseif ($buttonSettings[0]['selected_items'] != 1 && $buttonSettings[0]['hide_advanced']) {

            } else {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_advanced', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_container', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_alignment', 'FoundationZurbFramework') . "</th>";
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                $itemContent .= ($buttonSettings[0]['container'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                $itemContent .= ($buttonSettings[0]['container'] != 1 ? '<td>Container not active</td>' : ($buttonSettings[0]['position'] === '' ? '<td> align-left</td>' : '<td>' . $buttonSettings[0]['position'] . '</td>'));
                $itemContent .= '</tr>';
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            }

            if ($buttonSettings[0]['selected_items'] && $buttonSettings[0]['hide_content'] != 1) {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_content', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table content_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                if (strpos($buttonSettings[0]['selected_items'], 'button_title') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_title', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($buttonSettings[0]['selected_items'], 'button_link') !== false) {
                    $itemContent .="<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_link', 'FoundationZurbFramework') . "</th>";
                }
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                if (strpos($buttonSettings[0]['selected_items'], 'button_title') !== false) {
                    $itemContent .= '<td> ' . substr($buttonSettings[0]['title'], 0, $buttonSettings[0]['title_crop']) . '</td>';
                }
                if (strpos($buttonSettings[0]['selected_items'], 'button_link') !== false) {
                    $itemContent .= Helper::createLink($buttonSettings[0]['link'], $buttonSettings[0]['link_crop']);
                }
                $itemContent .= '</tr>';
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            } elseif ($buttonSettings[0]['selected_items'] != 1 && $buttonSettings[0]['hide_content']) {

            } else {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_content', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table content_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_title', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_link', 'FoundationZurbFramework') . "</th>";
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                $itemContent .= '<td> ' . substr($buttonSettings[0]['title'], 0, $buttonSettings[0]['title_crop']) . '</td>';
                $itemContent .= Helper::createLink($buttonSettings[0]['link'], $buttonSettings[0]['link_crop']);
                $itemContent .= '</tr>';
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            }

            $drawItem = false;
        }
    }

}