<?php
namespace Karavas\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;

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
   )
   {
      if ($row['CType'] === 'foundation_group_button') {

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_buttongroupsettings');
        $groupButtonSettings = $queryBuilder
          ->select('position', 'container', 'expanded', 'stacked', 'color', 'size', 'uid', 'selected_items', 'hide_settings', 'hide_content', 'hide_advanced', 'title_crop', 'link_crop', 'limit_content')
          ->from('foundation_zurb_buttongroupsettings')
          ->where( 
            $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['buttongroup_settings_relation'],\PDO::PARAM_INT)),
            $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
            $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchAll();

        $queryBuilderContent = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_buttongroupcontent');
        $buttonGroupContent = $queryBuilderContent 
        ->select('title', 'link', 'uid', 'color', 'hollow', 'clear', 'disabled' )
        ->from('foundation_zurb_buttongroupcontent')
        ->where(
          $queryBuilderContent->expr()->eq('foundation_zurb_buttongroupsettings',  $queryBuilderContent->createNamedParameter($groupButtonSettings[0]['uid'], \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchAll();


        $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';

        $itemContent .= '<table class="foundation_table one_table">';
          $itemContent .= '<tbody>';
          if ($groupButtonSettings[0]['selected_items'] && $groupButtonSettings[0]['hide_settings'] != 1) {
            $itemContent .= '<tr>';
              if (strpos($groupButtonSettings[0]['selected_items'], 'foundation_sizing') !== false) {
                $itemContent .= '<th>Size</th>';
              }
              if (strpos($groupButtonSettings[0]['selected_items'], 'button_color') !== false) {
                $itemContent .= '<th>Color</th>';
              }
              if (strpos($groupButtonSettings[0]['selected_items'], 'button_stacked') !== false) {
                $itemContent .= '<th>Stacked</th>';
              }
              $itemContent .= '</tr>';
              $itemContent .= '<tr>';
              if (strpos($groupButtonSettings[0]['selected_items'], 'foundation_sizing') !== false) {
                $itemContent .= ($groupButtonSettings[0]['size'] ==='' ? '<td> Normal</td>' : '<td>'.$groupButtonSettings[0]['size'].'</td>');
              }
              if (strpos($groupButtonSettings[0]['selected_items'], 'button_color') !== false) {
                $itemContent .= '<td>'.$groupButtonSettings[0]['color'].'</td>';
              }
              if (strpos($groupButtonSettings[0]['selected_items'], 'button_stacked') !== false) {
                $itemContent .= ($groupButtonSettings[0]['stacked'] ===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
              }
            $itemContent .= '</tr>';
          } elseif ($groupButtonSettings[0]['selected_items'] != 1 && $groupButtonSettings[0]['hide_settings'] == 1) {
            
          } else {
            $itemContent .= '<tr>';
              $itemContent .= '<th>Size</th>';
              $itemContent .= '<th>Color</th>';
              $itemContent .= '<th>Stacked</th>';
            $itemContent .= '<tr>';
            $itemContent .= '<tr>';
              $itemContent .= ($groupButtonSettings[0]['size'] ==='' ? '<td> Normal</td>' : '<td>'.$groupButtonSettings[0]['size'].'</td>');
              $itemContent .= '<td>'.$groupButtonSettings[0]['color'].'</td>';
              $itemContent .= ($groupButtonSettings[0]['stacked'] ===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
              $itemContent .= '</tr>';
          }
         $itemContent .= '</tbody>';
      $itemContent .= '</table>';

      if ($groupButtonSettings[0]['selected_items'] && $groupButtonSettings[0]['hide_advanced'] != 1) {
          $itemContent .= '<strong class="foundation_subtitle">Advanced</strong>';
          $itemContent .= '<table class="foundation_table">';
            $itemContent .= '<tbody>';
              $itemContent .= '<tr>';
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_container') !== false) {
                    $itemContent .= '<th>Container</th>';
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_position') !== false) {
                    $itemContent .= '<th>Align</th>';
                }
                $itemContent .= '</tr>';
                $itemContent .= '<tr>';
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_container') !== false) {
                    $itemContent .= ($groupButtonSettings[0]['container'] ===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_position') !== false) {
                    $itemContent .= ($groupButtonSettings[0]['container'] !=1 ? '<td>Container not active</td>' : ($groupButtonSettings[0]['position'] === '' ? '<td> align-left</td>' : '<td>'.$groupButtonSettings[0]['position'].'</td>'));
                }
              $itemContent .= '</tr>';
            $itemContent .= '</tbody>';
          $itemContent .= '</table>';
        } elseif ($groupButtonSettings[0]['selected_items'] != 1 && $groupButtonSettings[0]['hide_advanced'] == 1) {
          
        } else {
          $itemContent .= '<strong class="foundation_subtitle">Advanced</strong>';
          $itemContent .= '<table class="foundation_table">';
            $itemContent .= '<tbody>';
              $itemContent .= '<tr>';
                $itemContent .= '<th>Container</th>';
                $itemContent .= '<th>Align</th>';
              $itemContent .= '</tr>';
              $itemContent .= '<tr>';
                $itemContent .= ($groupButtonSettings[0]['container'] ===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
                $itemContent .= ($groupButtonSettings[0]['container'] !=1 ? '<td>Container not active</td>' : ($groupButtonSettings[0]['position'] === '' ? '<td> align-left</td>' : '<td>'.$groupButtonSettings[0]['position'].'</td>'));
              $itemContent .= '</tr>';
            $itemContent .= '</tbody>';
          $itemContent .= '</table>';
        }
        

        if ($groupButtonSettings[0]['selected_items'] && $groupButtonSettings[0]['hide_content'] != 1) {
          $itemContent .= '<strong class="foundation_subtitle">Content</strong>';
          $itemContent .= '<table class="foundation_table content_table">';
            $itemContent .= '<tbody>';
              $itemContent .= '<tr>';
                if (strpos($groupButtonSettings[0]['selected_items'], 'foundation_listing') !== false) {
                  $itemContent .= '<th class="listing"></th>';
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_title') !== false) {
                  $itemContent .= '<th class="secondaryStyle">Title</th>';
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_link') !== false) {
                  $itemContent .= '<th class="secondaryStyle">Link</th>';
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_color_content') !== false) {
                  $itemContent .= '<th class="secondaryStyle">Color</th>';
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_hollow') !== false) {
                  $itemContent .= '<th class="secondaryStyle">Hollow</th>';
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_clear') !== false) {
                  $itemContent .= '<th class="secondaryStyle">Clear</th>';
                }
                if (strpos($groupButtonSettings[0]['selected_items'], 'button_disabled') !== false) {
                  $itemContent .= '<th class="secondaryStyle">Disabled</th>';
                }
              $itemContent .= '</tr>';
              $listNumber = 0;
              foreach (array_slice($buttonGroupContent, 0, $groupButtonSettings[0]['limit_content']) as $bgContent) {
                $listNumber++;
                $itemContent .= '<tr>';
                  if (strpos($groupButtonSettings[0]['selected_items'], 'foundation_listing') !== false) {
                    $itemContent .= '<td>'.$listNumber .'.</td>';
                  }
                  if (strpos($groupButtonSettings[0]['selected_items'], 'button_title') !== false) {
                    $itemContent .= '<td>'.substr($bgContent['title'], 0, $groupButtonSettings[0]['title_crop']) .'</td>';
                  }
                  if (strpos($groupButtonSettings[0]['selected_items'], 'button_link') !== false) {
                    $itemContent .= '<td>'.substr($bgContent['link'], 0, $groupButtonSettings[0]['link_crop']) .'</td>';
                  }
                  if (strpos($groupButtonSettings[0]['selected_items'], 'button_color_content') !== false) {
                    $itemContent .= '<td>'.($groupButtonSettings[0]['color'] === 'undefined' ? $bgContent['color'] : 'Defined on parent').'</td>';
                  }
                  if (strpos($groupButtonSettings[0]['selected_items'], 'button_hollow') !== false) {
                    $itemContent .= '<td>'.($bgContent['hollow'] ===1 ? '&#10004;' : '&#10008').'</td>';
                  }
                  if (strpos($groupButtonSettings[0]['selected_items'], 'button_clear') !== false) {
                    $itemContent .= '<td>'.($bgContent['clear'] ===1 ? '&#10004;' : '&#10008').'</td>';
                  }
                  if (strpos($groupButtonSettings[0]['selected_items'], 'button_disabled') !== false) {
                    $itemContent .= '<td>'.($bgContent['disabled'] ===1 ? '&#10004;' : '&#10008').'</td>';
                  }
                $itemContent .= '</tr>';
                $countNumber +=1;
              }
            $itemContent .= '</tbody>';
          $itemContent .= '</table>';
        } elseif ($groupButtonSettings[0]['selected_items'] != 1 && $groupButtonSettings[0]['hide_content']) {
            
        } else {
          $itemContent .= '<strong class="foundation_subtitle">Content</strong>';
          $itemContent .= '<table class="foundation_table content_table">';
            $itemContent .= '<tbody>';
              $itemContent .= '<tr>';
                $itemContent .= '<th class="listing"></th>';
                $itemContent .= '<th class="secondaryStyle">Title</th>';
                $itemContent .= '<th class="secondaryStyle">Link</th>';
                $itemContent .= '<th class="secondaryStyle">Color</th>';
                $itemContent .= '<th class="secondaryStyle">Hollow</th>';
                $itemContent .= '<th class="secondaryStyle">Clear</th>';
                $itemContent .= '<th class="secondaryStyle">Disabled</th>';
              $itemContent .= '</tr>';
              $listNumber = 0;
              foreach (array_slice($buttonGroupContent, 0, $groupButtonSettings[0]['limit_content']) as $bgContent) {
                $listNumber++;
                $itemContent .= '<tr>';
                  $itemContent .= '<td>'.$listNumber .'.</td>';
                  $itemContent .= '<td>'.substr($bgContent['title'], 0, $groupButtonSettings[0]['title_crop']) .'</td>';
                  $itemContent .= '<td>'.substr($bgContent['link'], 0, $groupButtonSettings[0]['link_crop']).'</td>';
                  $itemContent .= '<td>'.($groupButtonSettings[0]['color'] === 'undefined' ? $bgContent['color'] : 'Defined on parent').'</td>';
                  $itemContent .= '<td>'.($bgContent['hollow'] ===1 ? '&#10004;' : '&#10008').'</td>';
                  $itemContent .= '<td>'.($bgContent['clear'] ===1 ? '&#10004;' : '&#10008').'</td>';
                  $itemContent .= '<td>'.($bgContent['disabled'] ===1 ? '&#10004;' : '&#10008').'</td>';
                $itemContent .= '</tr>';
                $countNumber +=1;
              }
            $itemContent .= '</tbody>';
          $itemContent .= '</table>';
        }
        $drawItem = false;
    }
  }
}