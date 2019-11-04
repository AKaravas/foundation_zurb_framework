<?php

namespace Karavas\FoundationZurbFramework\Hooks\PageLayoutView;

use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Contains a preview rendering for the page module of CType="foundation_tabs"
 */
class TabsPreviewRenderer implements PageLayoutViewDrawItemHookInterface
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


        if ($row['CType'] === 'foundation_tabs') {

            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_tabssettings');
            $tabsSettings = $queryBuilder
                ->select('deep_linking', 'collapse_tabs', 'vertical_tabs', 'title_crop', 'text_crop', 'uid',
                    'selected_items', 'hide_settings', 'hide_content', 'limit_content')
                ->from('foundation_zurb_tabssettings')
                ->where(
                    $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['tabs_settings_relation'], \PDO::PARAM_INT)),
                    $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
                    $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
                )
                ->execute()
                ->fetchAll();

            $queryBuilderContent = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_tabscontent');
            $tabsContent = $queryBuilderContent
                ->select('title', 'text', 'image', 'uid')
                ->from('foundation_zurb_tabscontent')
                ->where(
                    $queryBuilderContent->expr()->eq('foundation_zurb_tabssettings',
                        $queryBuilderContent->createNamedParameter($tabsSettings[0]['uid'], \PDO::PARAM_INT))
                )
                ->execute()
                ->fetchAll();


            $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
            $itemContent .= '<table class="foundation_table">';
            $itemContent .= '<tbody>';
            if ($tabsSettings[0]['selected_items'] && $tabsSettings[0]['hide_settings'] != 1) {
                if (strpos($tabsSettings[0]['selected_items'], 'tabs_vertical_tabs') !== false) {
                    $itemContent .= '<tr>';
                    $itemContent .= "<th>" . LocalizationUtility::translate('foundation_tabs_vertical', 'FoundationZurbFramework') . "</th>";
                    $itemContent .= ($tabsSettings[0]['vertical_tabs'] === 1 ? '<td> &#10004;</td></tr>' : '<td> &#10008;</td>');
                    $itemContent .= '</tr>';
                }
                if (strpos($tabsSettings[0]['selected_items'], 'tabs_collapse_tabs') !== false) {
                    $itemContent .= '<tr>';
                    $itemContent .= "<th>" . LocalizationUtility::translate('foundation_tabs_collapse', 'FoundationZurbFramework') . "</th>";
                    $itemContent .= ($tabsSettings[0]['collapse_tabs'] === 1 ? '<td> &#10004;</td></tr>' : '<td> &#10008;</td>');
                    $itemContent .= '</tr>';
                }
                if (strpos($tabsSettings[0]['selected_items'], 'tabs_deep_linking') !== false) {
                    $itemContent .= '<tr>';
                    $itemContent .= "<th>" . LocalizationUtility::translate('foundation_tabs_deep_linking', 'FoundationZurbFramework') . "</th>";
                    $itemContent .= ($tabsSettings[0]['deep_liniking'] === 1 ? '<td> &#10004;</td></tr>' : '<td> &#10008;</td>');
                    $itemContent .= '</tr>';
                }
            } elseif ($tabsSettings[0]['selected_items'] != 1 && $tabsSettings[0]['hide_settings']) {

            } else {
                $itemContent .= '<tr>';
                $itemContent .= "<th>" . LocalizationUtility::translate('foundation_tabs_vertical', 'FoundationZurbFramework') . "</th>";
                $itemContent .= ($tabsSettings[0]['vertical_tabs'] === 1 ? '<td> &#10004;</td></tr>' : '<td> &#10008;</td>');
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                $itemContent .= "<th>" . LocalizationUtility::translate('foundation_tabs_collapse', 'FoundationZurbFramework') . "</th>";
                $itemContent .= ($tabsSettings[0]['collapse_tabs'] === 1 ? '<td> &#10004;</td></tr>' : '<td> &#10008;</td>');
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                $itemContent .= "<th>" . LocalizationUtility::translate('foundation_tabs_deep_linking', 'FoundationZurbFramework') . "</th>";
                $itemContent .= ($tabsSettings[0]['deep_liniking'] === 1 ? '<td> &#10004;</td></tr>' : '<td> &#10008;</td>');
                $itemContent .= '</tr>';
            }

            $itemContent .= '</tbody>';
            $itemContent .= '</table>';

            if ($tabsSettings[0]['selected_items'] && $tabsSettings[0]['hide_content'] != 1) {
                $itemContent .= "<strong class='foundation_subtitle'>" . LocalizationUtility::translate('foundation_content', 'FoundationZurbFramework') . "</strong>";
                $itemContent .= '<table class="foundation_table content_table">';
                $itemContent .= '<tbody>';
                $itemContent .= '<tr>';
                if (strpos($tabsSettings[0]['selected_items'], 'foundation_listing') !== false) {
                    $itemContent .= '<th class="listing"></th>';
                }
                if (strpos($tabsSettings[0]['selected_items'], 'tabs_title') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_title', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($tabsSettings[0]['selected_items'], 'tabs_text') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_text', 'FoundationZurbFramework') . "</th>";
                }
                if (strpos($tabsSettings[0]['selected_items'], 'tabs_image') !== false) {
                    $itemContent .= "<th class='secondaryStyle'>" . LocalizationUtility::translate('foundation_files', 'FoundationZurbFramework') . "</th>";
                }
                $itemContent .= '</tr>';
                $listNumber = 0;
                foreach (array_slice($tabsContent, 0, $tabsSettings[0]['limit_content']) as $tabContent) {
                    $listNumber++;
                    if ($tabContent['image'] == 1) {
                        $fileExist = 'File exists';
                    } else {
                        $fileExist = 'File does not exist';
                    }
                    $itemContent .= '<tr>';
                    if (strpos($tabsSettings[0]['selected_items'], 'foundation_listing') !== false) {
                        $itemContent .= '<td>' . $listNumber . '</td>';
                    }
                    if (strpos($tabsSettings[0]['selected_items'], 'tabs_title') !== false) {
                        $itemContent .= '<td>' . substr($tabContent['title'], 0, $tabsSettings[0]['title_crop']) . '</td>';
                    }
                    if (strpos($tabsSettings[0]['selected_items'], 'tabs_text') !== false) {
                        $itemContent .= '<td>' . strip_tags(substr($tabContent['text'], 0, $tabsSettings[0]['text_crop'])) . '</td>';
                    }
                    if (strpos($tabsSettings[0]['selected_items'], 'tabs_image') !== false) {
                        $itemContent .= '<td>' . $fileExist . '</td>';
                    }
                    $itemContent .= '</tr>';
                }
                $itemContent .= '</tbody>';
                $itemContent .= '</table>';

            } elseif ($tabsSettings[0]['selected_items'] != 1 && $tabsSettings[0]['hide_content']) {

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
                foreach (array_slice($tabsContent, 0, $tabsSettings[0]['limit_content']) as $tabContent) {
                    $listNumber++;
                    if ($tabContent['image'] == 1) {
                        $fileExist = 'File exists';
                    } else {
                        $fileExist = 'File does not exist';
                    }
                    $itemContent .= '<tr>';
                    $itemContent .= '<td>' . $listNumber . '</td>';
                    $itemContent .= '<td>' . substr($tabContent['title'], 0, $tabsSettings[0]['title_crop']) . '</td>';
                    $itemContent .= '<td>' . strip_tags(substr($tabContent['text'], 0, $tabsSettings[0]['text_crop'])) . '</td>';
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