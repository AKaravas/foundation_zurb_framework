<?php

namespace Karavas\FoundationZurbFramework\Hooks\PageLayoutView;

use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Contains a preview rendering for the page module of CType="foundation_reveal"
 */
class RevealPreviewRenderer implements PageLayoutViewDrawItemHookInterface
{

    /**
     * Preprocesses the preview rendering of a content element of type "Foundation Modal/Reveal"
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

        if ($row['CType'] === 'foundation_reveal') {
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_revealcontent');
            $revealInfos = $queryBuilder
                ->select('*')
                ->from('foundation_zurb_revealcontent')
                ->where(
                    $queryBuilder->expr()->eq('tt_content', $queryBuilder->createNamedParameter($row['uid'], \PDO::PARAM_INT)),
                    $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
                    $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
                )
                ->execute()
                ->fetchAll();
            $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
            $itemContent .= '<table class="foundation_table one_table">';
            $itemContent .= '<tbody>';
            if ($revealInfos[0]['selected_items'] && $revealInfos[0]['hide_content'] != 1) {
                $itemContent .= '<tr>';
                if (strpos($revealInfos[0]['selected_items'], 'foundation_listing') !== false) {
                    $itemContent .= '<th class="listing"></th>';
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_title') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_title', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_text') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_text', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_files') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_files', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_size') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_reveal_size', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'button_size') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_button_size', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_no_overlay') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_reveal_settings_no_overlay', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_no_animation') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_disable_animations', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_animation_out') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_animation_out', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_animation_in') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_animation_in', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_animation_speed_in') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_speed_in', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_animation_speed_out') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_speed_out', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_show_delay') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_show_delay', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_hide_delay') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_hide_delay', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_close_on_click') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_close_on_click', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_close_on_esc') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_close_on_esc', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_v_offset') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_v_offset', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_h_offset') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_h_offset', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_reset_on_close') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_reveal_settings_reset_on_close', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_color') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_color', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_hollow') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_styling_hollow', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_clear') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_styling_clear', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($revealInfos[0]['selected_items'], 'reveal_disabled') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_disabled', 'FoundationZurbFramework') . "</th>";
                }
                $itemContent .= '</tr>';
                $listNumber = 0;
                foreach (array_slice($revealInfos, 0, $revealInfos[0]['limit_content']) as $reveal) {
                    $listNumber++;
                    if ($reveal['files'] == 1) {
                        $fileExist = 'File exists';
                    } else {
                        $fileExist = 'File does not exist';
                    }
                    $itemContent .= '<tr>';
                    if (strpos($revealInfos[0]['selected_items'], 'foundation_listing') !== false) {
                        $itemContent .= '<td>' . $listNumber . '.</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_title') !== false) {
                        $itemContent .= '<td>' . substr($reveal['title'], 0, $revealInfos[0]['title_crop']) . '</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_text') !== false) {
                        $itemContent .= '<td>' . strip_tags(substr($reveal['text'], 0, $revealInfos[0]['text_crop'])) . '</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_files') !== false) {
                        $itemContent .= '<td>' . $fileExist . '</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_size') !== false) {
                        $itemContent .= '<td>' . $reveal['size'] . '</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'button_size') !== false) {
                        $itemContent .= (empty($reveal['button_size']) ? '<td>Normal</td>' : '<td>' . $reveal['button_size'] . '</td>');
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_no_overlay') !== false) {
                        $itemContent .= '<td>' . ($reveal['no_overlay'] === 1 ? '&#10004; </td>' : '&#10008; </td>');
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_no_animation') !== false) {
                        $itemContent .= '<td>' . ($reveal['no_overlay'] === 1 ? '&#10004; </td>' : '&#10008; </td>');
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_animation_out') !== false) {
                        $itemContent .= '<td>' . $reveal['animation_out'] . '</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_animation_in') !== false) {
                        $itemContent .= '<td>' . $reveal['animation_in'] . '</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_animation_speed_in') !== false) {
                        $itemContent .= '<td>' . $reveal['animation_speed_in'] . '</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_animation_speed_out') !== false) {
                        $itemContent .= '<td>' . $reveal['animation_speed_out'] . '</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_show_delay') !== false) {
                        $itemContent .= '<td>' . $reveal['show_delay'] . '</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_hide_delay') !== false) {
                        $itemContent .= '<td>' . $reveal['hide_delay'] . '</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_close_on_click') !== false) {
                        $itemContent .= '<td>' . ($reveal['close_on_click'] === 1 ? '&#10004; </td>' : '&#10008; </td>');
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_close_on_esc') !== false) {
                        $itemContent .= '<td>' . ($reveal['close_on_esc'] === 1 ? '&#10004; </td>' : '&#10008; </td>');
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_v_offset') !== false) {
                        $itemContent .= '<td>' . $reveal['v_offset'] . '</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_h_offset') !== false) {
                        $itemContent .= '<td>' . $reveal['h_offset'] . '</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_reset_on_close') !== false) {
                        $itemContent .= '<td>' . ($reveal['reset_on_close'] === 1 ? '&#10004; </td>' : '&#10008; </td>');
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_color') !== false) {
                        $itemContent .= '<td>' . $reveal['color'] . '</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_hollow') !== false) {
                        $itemContent .= '<td>' . $reveal['hollow'] . '</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_clear') !== false) {
                        $itemContent .= '<td>' . $reveal['clear'] . '</td>';
                    }
                    if (strpos($revealInfos[0]['selected_items'], 'reveal_disabled') !== false) {
                        $itemContent .= '<td>' . $reveal['disabled'] . '</td>';
                    }
                    $itemContent .= '<tr>';
                }
            } elseif ($revealInfos[0]['selected_items'] != 1 && $revealInfos[0]['hide_content']) {

            } else {
                $itemContent .= '<tr>';
                $itemContent .= '<th class="listing"></th>';
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_title', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_text', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_reveal_size', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_button_size', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_color', 'FoundationZurbFramework') . "</th>";
                $itemContent .= '</tr>';
                $listNumber = 0;
                foreach (array_slice($revealInfos, 0, $revealInfos[0]['limit_content']) as $reveal) {
                    $listNumber++;
                    $itemContent .= '<tr>';
                    $itemContent .= '<td>' . $listNumber . '.</td>';
                    $itemContent .= '<td>' . substr($reveal['title'], 0, $revealInfos[0]['title_crop']) . '</td>';
                    $itemContent .= '<td>' . strip_tags(substr($reveal['text'], 0, $revealInfos[0]['text_crop'])) . '</td>';
                    $itemContent .= '<td>' . $reveal['size'] . '</td>';
                    $itemContent .= (empty($reveal['button_size']) ? '<td>Normal</td>' : '<td>' . $reveal['button_size'] . '</td>');
                    $itemContent .= '<td>' . $reveal['color'] . '</td>';
                    $itemContent .= '</tr>';
                }
            }
            $itemContent .= '</tbody>';
            $itemContent .= '</table>';

            $drawItem = false;
        }
    }
}