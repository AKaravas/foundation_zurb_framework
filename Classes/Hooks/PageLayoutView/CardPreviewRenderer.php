<?php
namespace Karavas\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;

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
   )
   {
    
      if ($row['CType'] === 'foundation_card') {

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_cardsettings');
        $cardSettings = $queryBuilder
          ->select('large_items', 'medium_items', 'small_items', 'use_container','uid', 'title_crop', 'text_crop', 'selected_items', 'hide_settings', 'hide_content', 'hide_advanced', 'link_crop', 'limit_content' )
          ->from('foundation_zurb_cardsettings')
          ->where( 
            $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['card_settings_relation'],\PDO::PARAM_INT)),
            $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
            $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchAll();

        $queryBuilderContent = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_cardcontent');
        $cardContent = $queryBuilderContent 
        ->select('title', 'text', 'files', 'uid', 'card_link')
        ->from('foundation_zurb_cardcontent')
        ->where(
          $queryBuilderContent->expr()->eq('foundation_zurb_cardsettings',  $queryBuilderContent->createNamedParameter($cardSettings[0]['uid'], \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchAll();

        $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';

        $itemContent .= '<table class="foundation_table">';
          $itemContent .= '<tbody>';
            if ($cardSettings[0]['selected_items'] && $cardSettings[0]['hide_settings'] != 1) {
              if (strpos($cardSettings[0]['selected_items'], 'items_on_small') !== false) {
                $itemContent .= '<tr>';
                  $itemContent .= '<th>Items on small</th>';
                  $itemContent .= '<td>' . $cardSettings[0]['small_items'] . '</td>';
                $itemContent .= '</tr>';
              }
              if (strpos($cardSettings[0]['selected_items'], 'items_on_medium') !== false) {
                $itemContent .= '<tr>';
                  $itemContent .= '<th>Items on medium</th>';
                  $itemContent .= '<td>' . $cardSettings[0]['medium_items'] . '</td>';
                $itemContent .= '</tr>';
              }
              if (strpos($cardSettings[0]['selected_items'], 'items_on_large') !== false) {
                $itemContent .= '<tr>';
                  $itemContent .= '<th>Items on large</th>';
                  $itemContent .= '<td>' . $cardSettings[0]['large_items'] . '</td>';
                $itemContent .= '</tr>';
              }
            } elseif ($cardSettings[0]['selected_items'] != 1&& $cardSettings[0]['hide_settings']) {
              
            } else {
              $itemContent .= '<tr>';
                $itemContent .= '<th>Items on small</th>';
                $itemContent .= '<td>' . $cardSettings[0]['small_items'] . '</td>';
              $itemContent .= '</tr>';
              $itemContent .= '<tr>';
                $itemContent .= '<th>Items on medium</th>';
                $itemContent .= '<td>' . $cardSettings[0]['medium_items'] . '</td>';
              $itemContent .= '</tr>';
              $itemContent .= '<tr>';
                $itemContent .= '<th>Items on large</th>';
                $itemContent .= '<td>' . $cardSettings[0]['large_items'] . '</td>';
              $itemContent .= '</tr>';
            }
          $itemContent .= '</tbody>';
        $itemContent .= '</table>';

        if ($cardSettings[0]['selected_items'] && $cardSettings[0]['hide_advanced'] != 1) {
          $itemContent .= '<strong class="foundation_subtitle">Card container</strong>';
          $itemContent .= '<table class="foundation_table">';
            $itemContent .= '<tbody>';
              $itemContent .= '<tr>';
                if (strpos($cardSettings[0]['selected_items'], 'card_container') !== false) {
                  $itemContent .= '<th>Remove container</th>';
                  $itemContent .= ($cardSettings[0]['use_container']===1 ? '<td> &#10004;</td></tr>' : '<td> &#10008;</td>');
                }
              $itemContent .= '</tr>';
            $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        } elseif ($cardSettings[0]['selected_items'] != 1 && $cardSettings[0]['hide_advanced']) {
          
        } else {
          $itemContent .= '<strong class="foundation_subtitle">Card container</strong>';
          $itemContent .= '<table class="foundation_table">';
            $itemContent .= '<tbody>';
              $itemContent .= '<tr>';
                $itemContent .= '<th>Remove container</th>';
                $itemContent .= ($cardSettings[0]['use_container']===1 ? '<td> &#10004;</td></tr>' : '<td> &#10008;</td>');
              $itemContent .= '</tr>';
            $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        }

        if ($cardSettings[0]['selected_items'] && $cardSettings[0]['hide_content'] != 1) {
          $itemContent .= '<strong class="foundation_subtitle">Content</strong>';
          $itemContent .= '<table class="foundation_table content_table">';
            $itemContent .= '<tbody>';
              $itemContent .= '<tr>';
                if (strpos($cardSettings[0]['selected_items'], 'foundation_listing') !== false) {
                  $itemContent .= '<th class="listing"></th>';
                }
                if (strpos($cardSettings[0]['selected_items'], 'card_title') !== false) {
                  $itemContent .= '<th class="secondaryStyle">Title</th>';
                }
                if (strpos($cardSettings[0]['selected_items'], 'card_text') !== false) {
                  $itemContent .= '<th class="secondaryStyle">Text</th>';
                }
                if (strpos($cardSettings[0]['selected_items'], 'card_link') !== false) {
                  $itemContent .= '<th class="secondaryStyle">Link</th>';
                }
                if (strpos($cardSettings[0]['selected_items'], 'card_files') !== false) {
                  $itemContent .= '<th class="secondaryStyle">Files</th>';
                }
              $itemContent .= '</tr>';
              $listNumber = 0;
              foreach (array_slice($cardContent, 0, $cardSettings[0]['limit_content']) as $caContent) {
                $listNumber++;
                if($caContent['files']==1) {
                  $fileExist = 'File exists';
                }
                else {
                  $fileExist = 'File does not exist';
                }
                $itemContent .= '<tr>';
                if (strpos($cardSettings[0]['selected_items'], 'foundation_listing') !== false) {
                  $itemContent .= '<td>'.$listNumber.'</td>';
                }
                if (strpos($cardSettings[0]['selected_items'], 'card_title') !== false) {
                  $itemContent .= '<td>'.substr($caContent['title'], 0, $cardSettings[0]['title_crop']).'</td>';
                }
                if (strpos($cardSettings[0]['selected_items'], 'card_text') !== false) {
                  $itemContent .= '<td>'.strip_tags(substr($caContent['text'], 0, $cardSettings[0]['text_crop'])).'</td>';
                }
                if (strpos($cardSettings[0]['selected_items'], 'card_link') !== false) {
                  $itemContent .= '<td>'.substr($caContent['card_link'], 0, $cardSettings[0]['link_crop']).'</td>';
                }
                if (strpos($cardSettings[0]['selected_items'], 'card_files') !== false) {
                  $itemContent .= '<td>'.$fileExist .'</td>';
                }
                $itemContent .= '</tr>';
              }
            $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        } elseif ($cardSettings[0]['selected_items'] != 1 && $cardSettings[0]['hide_content']) {
          
        } else {
          $itemContent .= '<strong class="foundation_subtitle">Content</strong>';
          $itemContent .= '<table class="foundation_table content_table">';
            $itemContent .= '<tbody>';
              $itemContent .= '<tr>';
                $itemContent .= '<th class="listing"></th>';
                $itemContent .= '<th class="secondaryStyle">Title</th>';
                $itemContent .= '<th class="secondaryStyle">Text</th>';
                $itemContent .= '<th class="secondaryStyle">Link</th>';
                $itemContent .= '<th class="secondaryStyle">Files</th>';
              $itemContent .= '</tr>';
              $listNumber = 0;
              foreach (array_slice($cardContent, 0, $cardSettings[0]['limit_content']) as $caContent) {
                $listNumber++;
                if($caContent['files']==1) {
                  $fileExist = 'File exists';
                }
                else {
                  $fileExist = 'File does not exist';
                }
                $itemContent .= '<tr>';
                  $itemContent .= '<td>'.$listNumber.'</td>';
                  $itemContent .= '<td>'.substr($caContent['title'], 0, $cardSettings[0]['title_crop']).'</td>';
                  $itemContent .= '<td>'.strip_tags(substr($caContent['text'], 0, $cardSettings[0]['text_crop'])).'</td>';
                  $itemContent .= '<td>'.substr($caContent['card_link'], 0, $cardSettings[0]['link_crop']).'</td>';
                  $itemContent .= '<td>'.$fileExist .'</td>';
                $itemContent .= '</tr>';
              }
            $itemContent .= '</tbody>';
          $itemContent .= '</table>';
        }

        $drawItem = false;
    }
  }
}