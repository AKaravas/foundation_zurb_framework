<?php

namespace Karavas\FoundationZurbFramework\Hooks\PageLayoutView;

use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Contains a preview rendering for the page module of CType="foundation_callout"
 */
class CalloutPreviewRenderer implements PageLayoutViewDrawItemHookInterface
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


        if ($row['CType'] === 'foundation_callout') {

            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_callout');
            $calloutSettings = $queryBuilder
                ->select('container', 'animation_out', 'is_closable', 'size', 'title', 'color', 'title_crop',
                    'text_crop', 'files', 'text', 'selected_items', 'hide_settings', 'hide_content')
                ->from('foundation_zurb_callout')
                ->where(
                    $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['callout_content_relation'], \PDO::PARAM_INT)),
                    $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
                    $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
                )
                ->execute()
                ->fetchAll();
            if ($calloutSettings[0]['files'] == 1) {
                $fileExist = 'File exists';
            } else {
                $fileExist = 'File does not exist';
            }

            $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';

            $itemContent .= '<table class="foundation_table one_table">';
            $itemContent .= '<tbody>';
            if ($calloutSettings[0]['selected_items'] && $calloutSettings[0]['hide_settings'] != 1) {
                $itemContent .= '<tr>';
                if (strpos($calloutSettings[0]['selected_items'], 'foundation_sizing') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_size', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($calloutSettings[0]['selected_items'], 'callout_color') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_color', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($calloutSettings[0]['selected_items'], 'callout_animation') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_animations', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($calloutSettings[0]['selected_items'], 'callout_closeable') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_closeable', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($calloutSettings[0]['selected_items'], 'callout_container') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_container', 'FoundationZurbFramework') . "</th>";
                }
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                if (strpos($calloutSettings[0]['selected_items'], 'foundation_sizing') !== false) {
                    $itemContent .= ($calloutSettings[0]['size'] === '' ? '<td> Normal</td>' : '<td>' . $calloutSettings[0]['size'] . '</td>');
                }
                if (strpos($calloutSettings[0]['selected_items'], 'callout_color') !== false) {
                    $itemContent .= '<td> ' . $calloutSettings[0]['color'] . '</td>';
                }
                if (strpos($calloutSettings[0]['selected_items'], 'callout_animation') !== false) {
                    $itemContent .= ($calloutSettings[0]['animation_out'] === '' ? '<td> fade-out</td>' : '<td>' . $calloutSettings[0]['animation_out'] . '</td>');
                }
                if (strpos($calloutSettings[0]['selected_items'], 'callout_closeable') !== false) {
                    $itemContent .= ($calloutSettings[0]['is_closable'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                }
                if (strpos($calloutSettings[0]['selected_items'], 'callout_container') !== false) {
                    $itemContent .= ($calloutSettings[0]['container'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                }
                $itemContent .= '</tr>';
            } elseif ($calloutSettings[0]['selected_items'] != 1 && $calloutSettings[0]['hide_settings']) {

            } else {
                $itemContent .= '<tr>';
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_size', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_color', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_animation', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_closeable', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_container', 'FoundationZurbFramework') . "</th>";
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                $itemContent .= ($calloutSettings[0]['size'] === '' ? '<td> Normal</td>' : '<td>' . $calloutSettings[0]['size'] . '</td>');
                $itemContent .= '<td> ' . $calloutSettings[0]['color'] . '</td>';
                $itemContent .= ($calloutSettings[0]['animation_out'] === '' ? '<td> fade-out</td>' : '<td>' . $calloutSettings[0]['animation_out'] . '</td>');
                $itemContent .= ($calloutSettings[0]['is_closable'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                $itemContent .= ($calloutSettings[0]['container'] === 1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                $itemContent .= '</tr>';
            }
            $itemContent .= '</tbody>';
            $itemContent .= '</table>';

            if ($calloutSettings[0]['selected_items'] && $calloutSettings[0]['hide_content'] != 1) {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_content', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table content_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                if (strpos($calloutSettings[0]['selected_items'], 'callout_title') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_title', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($calloutSettings[0]['selected_items'], 'callout_text') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_text', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($calloutSettings[0]['selected_items'], 'callout_files') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_files', 'FoundationZurbFramework') . "</th>";
                }
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                if (strpos($calloutSettings[0]['selected_items'], 'callout_title') !== false) {
                    $itemContent .= '<td>' . substr($calloutSettings[0]['title'], 0,
                            $calloutSettings[0]['title_crop']) . '</td>';
                }
                if (strpos($calloutSettings[0]['selected_items'], 'callout_text') !== false) {
                    $itemContent .= '<td>' . strip_tags(substr($calloutSettings[0]['text'], 0,
                            $calloutSettings[0]['text_crop'])) . '</td>';
                }

                if (strpos($calloutSettings[0]['selected_items'], 'callout_files') !== false) {
                    $itemContent .= '<td>' . $fileExist . '</td>';
                }
                $itemContent .= '</tr>';
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            } elseif ($calloutSettings[0]['selected_items'] != 1 && $calloutSettings[0]['hide_content']) {

            } else {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_content', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table content_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_title', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_text', 'FoundationZurbFramework') . "</th>";
                $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_files', 'FoundationZurbFramework') . "</th>";
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                $itemContent .= '<td>' . substr($calloutSettings[0]['title'], 0, $calloutSettings[0]['title_crop']) . '</td>';
                $itemContent .= '<td>' . strip_tags(substr($calloutSettings[0]['text'], 0, $calloutSettings[0]['text_crop'])) . '</td>';
                $itemContent .= '<td>' . $fileExist . '</td>';
                $itemContent .= '</tr>';
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';
            }

            $drawItem = false;
        }
    }
}