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
class ButtonGroupPreviewRenderer implements PageLayoutViewDrawItemHookInterface
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
        if ($row['CType'] === 'foundation_group_button') {

            $groupButtonSettings = DatabaseQueries::getTableInfosByUid('foundation_zurb_buttongroupsettings', $row['buttongroup_settings_relation'], 'uid');
            $buttonGroupContent = DatabaseQueries::getTableInfosByUid('foundation_zurb_buttongroupcontent', $groupButtonSettings[0]['uid'], 'foundation_zurb_buttongroupsettings');

            $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';

            $itemContent .= '<table class="foundation_table one_table">';
            $itemContent .= '<tbody>';
            if ($groupButtonSettings[0]['selected_items'] && $groupButtonSettings[0]['hide_settings'] != 1) {
                $itemContent .= '<tr>';
                if (strpos($groupButtonSettings[0]['selected_items'], 'foundation_sizing') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_size', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_color') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_color', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_stacked') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_stacked', 'FoundationZurbFramework') . "</th>";
                }
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                if (strpos($groupButtonSettings[0]['selected_items'], 'foundation_sizing') !== false) {
                    $itemContent .= ($groupButtonSettings[0]['size'] === '' ? '<td> Normal</td>' : '<td>' . $groupButtonSettings[0]['size'] . '</td>');
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_color') !== false) {
                    $itemContent .= '<td>' . $groupButtonSettings[0]['color'] . '</td>';
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_stacked') !== false) {
                    $itemContent .= ($groupButtonSettings[0]['stacked'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                }
                $itemContent .= '</tr>';
            } elseif ($groupButtonSettings[0]['selected_items'] != 1 && $groupButtonSettings[0]['hide_settings'] == 1) {

            } else {
                $itemContent .= '<tr>';
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_size', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_color', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_stacked', 'FoundationZurbFramework') . "</th>";
                $itemContent .= '<tr>';
                $itemContent .= '<tr>';
                $itemContent .= ($groupButtonSettings[0]['size'] === '' ? '<td> Normal</td>' : '<td>' . $groupButtonSettings[0]['size'] . '</td>');
                $itemContent .= '<td>' . $groupButtonSettings[0]['color'] . '</td>';
                $itemContent .= ($groupButtonSettings[0]['stacked'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                $itemContent .= '</tr>';
            }
            $itemContent .= '</tbody>';
            $itemContent .= '</table>';

            if ($groupButtonSettings[0]['selected_items'] && $groupButtonSettings[0]['hide_advanced'] != 1) {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_advanced', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_container') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_container', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_position') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_alignment', 'FoundationZurbFramework') . "</th>";
                }
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_container') !== false) {
                    $itemContent .= ($groupButtonSettings[0]['container'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_position') !== false) {
                    $itemContent .= ($groupButtonSettings[0]['container'] != 1 ? "<td>" . LocalizationUtility::translate('foundation_container_disabled', 'FoundationZurbFramework') . "</td>" : ($groupButtonSettings[0]['position'] === '' ? '<td> align-left</td>' : '<td>' . $groupButtonSettings[0]['position'] . '</td>'));
                }
                $itemContent .= '</tr>';
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            } elseif ($groupButtonSettings[0]['selected_items'] != 1 && $groupButtonSettings[0]['hide_advanced'] == 1) {

            } else {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_advanced', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_container', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_alignment', 'FoundationZurbFramework') . "</th>";
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                $itemContent .= ($groupButtonSettings[0]['container'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                $itemContent .= ($groupButtonSettings[0]['container'] != 1 ? "<td>" . LocalizationUtility::translate('foundation_container_disabled', 'FoundationZurbFramework') . "</td>" : ($groupButtonSettings[0]['position'] === '' ? '<td> align-left</td>' : '<td>' . $groupButtonSettings[0]['position'] . '</td>'));
                $itemContent .= '</tr>';
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            }


            if ($groupButtonSettings[0]['selected_items'] && $groupButtonSettings[0]['hide_content'] != 1) {
                $itemContent .=  "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_content', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table content_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                if (strpos($groupButtonSettings[0]['selected_items'], 'foundation_listing') !== false) {
                    $itemContent .= '<th class="listing"></th>';
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_title') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_title', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_link') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_link', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_color_content') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_color', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_hollow') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_styling_hollow', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_clear') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_styling_clear', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_disabled') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_disabled', 'FoundationZurbFramework') . "</th>";
                }
                $itemContent .= '</tr>';
                $listNumber = 0;
                foreach (array_slice($buttonGroupContent, 0, $groupButtonSettings[0]['limit_content']) as $bgContent) {
                    $listNumber++;
                    $itemContent .= '<tr>';
                    if (strpos($groupButtonSettings[0]['selected_items'], 'foundation_listing') !== false) {$itemContent .= '<td>' . $listNumber . '.</td>';
                    }
                    if (strpos($groupButtonSettings[0]['selected_items'], 'button_title') !== false) {
                        $itemContent .= '<td>' . substr($bgContent['title'], 0, $groupButtonSettings[0]['title_crop']) . '</td>';
                    }
                    if (strpos($groupButtonSettings[0]['selected_items'], 'button_link') !== false) {
                        $itemContent .= Helper::createLink($bgContent['link'], $groupButtonSettings[0]['link_crop']);
                    }
                    if (strpos($groupButtonSettings[0]['selected_items'], 'button_color_content') !== false) {
                        $itemContent .= '<td>' . ($groupButtonSettings[0]['color'] === 'undefined' ? $bgContent['color'] : 'Defined on parent') . '</td>';
                    }
                    if (strpos($groupButtonSettings[0]['selected_items'], 'button_hollow') !== false) {
                        $itemContent .= '<td>' . ($bgContent['hollow'] === 1 ? '&#10004;' : '&#10008') . '</td>';
                    }
                    if (strpos($groupButtonSettings[0]['selected_items'], 'button_clear') !== false) {
                        $itemContent .= '<td>' . ($bgContent['clear'] === 1 ? '&#10004;' : '&#10008') . '</td>';
                    }
                    if (strpos($groupButtonSettings[0]['selected_items'], 'button_disabled') !== false) {
                        $itemContent .= '<td>' . ($bgContent['disabled'] === 1 ? '&#10004;' : '&#10008') . '</td>';
                    }
                    $itemContent .= '</tr>';
                }
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            } elseif ($groupButtonSettings[0]['selected_items'] != 1 && $groupButtonSettings[0]['hide_content']) {

            } else {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_content', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table content_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                $itemContent .= '<th class="listing"></th>';
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_size', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_link', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_color', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_styling_hollow', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_styling_clear', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_disabled', 'FoundationZurbFramework') . "</th>";
                $itemContent .= '</tr>';
                $listNumber = 0;
                foreach (array_slice($buttonGroupContent, 0, $groupButtonSettings[0]['limit_content']) as $bgContent) {
                    $listNumber++;
                    $itemContent .= '<tr>';
                    $itemContent .= '<td>' . $listNumber . '.</td>';
                    $itemContent .= '<td>' . substr($bgContent['title'], 0, $groupButtonSettings[0]['title_crop']) . '</td>';
                    $itemContent .= Helper::createLink($bgContent['link'], $groupButtonSettings[0]['link_crop']);
                    $itemContent .= '<td>' . ($groupButtonSettings[0]['color'] === 'undefined' ? $bgContent['color'] : 'Defined on parent') . '</td>';
                    $itemContent .= '<td>' . ($bgContent['hollow'] === 1 ? '&#10004;' : '&#10008') . '</td>';
                    $itemContent .= '<td>' . ($bgContent['clear'] === 1 ? '&#10004;' : '&#10008') . '</td>';
                    $itemContent .= '<td>' . ($bgContent['disabled'] === 1 ? '&#10004;' : '&#10008') . '</td>';
                    $itemContent .= '</tr>';
                }
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            }
            $drawItem = false;
        }
    }
}