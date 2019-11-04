<?php

namespace Karavas\FoundationZurbFramework\Hooks\PageLayoutView;

use Karavas\FoundationZurbFramework\Helper\DatabaseQueries;
use Karavas\FoundationZurbFramework\Helper\Helper;
use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Contains a preview rendering for the page module of CType="foundation_slider"
 */
class SliderPreviewRenderer implements PageLayoutViewDrawItemHookInterface
{

    /**
     * Preprocesses the preview rendering of a content element of type "Foundation Slider"
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
        if ($row['CType'] === 'foundation_slider') {

            $imageFields = ['uid', 'sorting'];
            $sliderSettings = DatabaseQueries::getTableInfosByUid('foundation_zurb_slidersettings', $row['slider_settings_relation'], 'uid');
            $sliderImages = DatabaseQueries::getTableInfosByUid('foundation_zurb_slidercontent', $sliderSettings[0]['uid'], 'foundation_zurb_slidersettings', $imageFields);
            $sortedCombined = Helper::getSliderImages($sliderImages);

            $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
            if ($sliderSettings[0]['hide_settings'] != 1) {
                $itemContent .= '<table class="foundation_table foundation_slider">';
                $itemContent .= '<tbody>';
                $itemContent .= ($sliderSettings[0]['hide_arrows'] === 1 ? "<tr><th>" . LocalizationUtility::translate('foundation_slider_hide_arrows',
                        'FoundationZurbFramework') . "</th> <td> &#10004;</td>" : "<tr><th>" . LocalizationUtility::translate('foundation_slider_hide_arrows',
                        'FoundationZurbFramework') . "</th> <td> &#10008;</td>");
                $itemContent .= ($sliderSettings[0]['hide_bullets'] === 1 ? "<th>" . LocalizationUtility::translate('foundation_slider_hide_bullets',
                        'FoundationZurbFramework') . "</th> <td> &#10004;</td></tr>" : "<th>" . LocalizationUtility::translate('foundation_slider_hide_bullets',
                        'FoundationZurbFramework') . "</th> <td> &#10008;</td></tr>");
                $itemContent .= ($sliderSettings[0]['auto_play'] === 1 ? "<tr><th>" . LocalizationUtility::translate('foundation_slider_auto_play',
                        'FoundationZurbFramework') . "</th> <td> &#10004;</td>" : "<tr><th>" . LocalizationUtility::translate('foundation_slider_auto_play',
                        'FoundationZurbFramework') . "</th> <td> &#10008;</td>");
                $itemContent .= ($sliderSettings[0]['infinite_wrap'] === 1 ? "<th>" . LocalizationUtility::translate('foundation_slider_infinite_wrap',
                        'FoundationZurbFramework') . "</th> <td> &#10004;</td></tr>" : "<th>" . LocalizationUtility::translate('foundation_slider_infinite_wrap',
                        'FoundationZurbFramework') . "</th> <td> &#10008;</td></tr>");
                $itemContent .= ($sliderSettings[0]['swipe'] === 1 ? "<tr><th>" . LocalizationUtility::translate('foundation_slider_swipe',
                        'FoundationZurbFramework') . "</th> <td> &#10004;</td>" : "<tr><th>" . LocalizationUtility::translate('foundation_slider_swipe',
                        'FoundationZurbFramework') . "</th> <td> &#10008;</td>");
                $itemContent .= ($sliderSettings[0]['pause_on_hover'] === 1 ? "<th>" . LocalizationUtility::translate('foundation_slider_pause_on_hover',
                        'FoundationZurbFramework') . "</th> <td> &#10004;</td></tr>" : "<th>" . LocalizationUtility::translate('foundation_slider_pause_on_hover',
                        'FoundationZurbFramework') . "</th> <td> &#10008;</td></tr>");
                $itemContent .= ($sliderSettings[0]['accessible_buttons'] === 1 ? "<tr><th>" . LocalizationUtility::translate('foundation_slider_keyboard_navigation',
                        'FoundationZurbFramework') . "</th> <td> &#10004;</td>" : "<tr><th>" . LocalizationUtility::translate('foundation_slider_keyboard_navigation',
                        'FoundationZurbFramework') . "</th> <td> &#10008;</td>");
                $itemContent .= ($sliderSettings[0]['use_m_u_i'] === 1 ? "<th>" . LocalizationUtility::translate('foundation_slider_use_mui',
                        'FoundationZurbFramework') . "</th> <td> &#10004;</td></tr>" : "<th>" . LocalizationUtility::translate('foundation_slider_use_mui',
                        'FoundationZurbFramework') . "</th> <td> &#10008;</td></tr>");
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            }

            if ($sliderSettings[0]['hide_animations'] != 1) {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_animations', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table foundation_slider">';
                $itemContent .= '<tbody>';
                $itemContent .= "<tr><th>" . LocalizationUtility::translate('foundation_slider_in_left', 'FoundationZurbFramework') . "</th> <td> " . $sliderSettings[0]['slide_direction_in_left'] . "</td>";
                $itemContent .= "<th>" . LocalizationUtility::translate('foundation_slider_out_left', 'FoundationZurbFramework') . "</th> <td>" . $sliderSettings[0]['slide_direction_out_left'] . "</td></tr>";
                $itemContent .= "<tr><th>" . LocalizationUtility::translate('foundation_slider_in_right', 'FoundationZurbFramework') . "</th> <td> " . $sliderSettings[0]['slide_direction_in_right'] . "</td>";
                $itemContent .= "<th>" . LocalizationUtility::translate('foundation_slider_out_right', 'FoundationZurbFramework') . "</th> <td>" . $sliderSettings[0]['slide_direction_out_right'] . "</td></tr>";
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            }

            if ($sliderSettings[0]['hide_timings'] != 1) {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_timer', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table">';
                $itemContent .= '<tbody>';
                $itemContent .= "<tr><th>" . LocalizationUtility::translate('foundation_slider_timer_delay', 'FoundationZurbFramework') . "</th> <td> " . $sliderSettings[0]['timer_delay'] . "</td></tr>";
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            }

            if ($sliderSettings[0]['hide_content'] != 1) {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_images', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                $searchText = " (auto-created)";
                foreach ($sortedCombined as $image) {
                    $itemContent .= '<td>' . $image[0] . '</td>';
                }
                $itemContent .= '</tr>';
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            }
            $drawItem = false;
        }
    }
}