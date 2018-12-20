<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;

/**
 * Contains a preview rendering for the page module of CType="foundation_reveal"
 */
class DropdownPreviewRenderer implements PageLayoutViewDrawItemHookInterface
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
   )
   {

    if ($row['CType'] === 'foundation_dropdown') {

      $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_dropdowncontent');
      $dropDownInfos = $queryBuilder
        ->select('*')
        ->from('foundation_zurb_dropdowncontent')
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

      if ($dropDownInfos[0]['selected_items'] && $dropDownInfos[0]['hide_content'] != 1) {
        $itemContent .= '<tr>';
          if (strpos($dropDownInfos[0]['selected_items'], 'foundation_listing') !== false) {
            $itemContent .= '<th class="listing"></th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_title') !== false) {
            $itemContent .= '<th>Title</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_text') !== false) {
            $itemContent .= '<th>Text</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_files') !== false) {
            $itemContent .= '<th>Files</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_hover') !== false) {
            $itemContent .= '<th>Hover</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_position') !== false) {
            $itemContent .= '<th>Position</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_alignment') !== false) {
            $itemContent .= '<th>Aligment</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_hover_panel') !== false) {
            $itemContent .= '<th>Hover pane</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_allow_bottom_overlap') !== false) {
            $itemContent .= '<th>Bottom overlap</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_trap_focus') !== false) {
            $itemContent .= '<th>Trap focus</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_auto_focus') !== false) {
            $itemContent .= '<th>Auto focus</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_v_offset') !== false) {
            $itemContent .= '<th>V offset</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_h_offset') !== false) {
            $itemContent .= '<th>H offset</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_close_on_click') !== false) {
            $itemContent .= '<th>Disable close on click</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_container') !== false) {
            $itemContent .= '<th>Container</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_color') !== false) {
            $itemContent .= '<th>Color</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_size') !== false) {
            $itemContent .= '<th>Size</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_hollow') !== false) {
            $itemContent .= '<th>Hollow</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_clear') !== false) {
            $itemContent .= '<th>Clear</th>';
          }
          if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_disabled') !== false) {
            $itemContent .= '<th>Disabled</th>';
          }
        $itemContent .= '</tr>';
        $listNumber = 0;
        foreach (array_slice($dropDownInfos, 0, $dropDownInfos[0]['limit_content']) as $dropdown) {
          $listNumber++;
          if($dropdown['files']==1) {
              $fileExist = 'File exists';
          }
          else {
            $fileExist = 'File does not exist';
          }
          $itemContent .= '<tr>';
            if (strpos($dropDownInfos[0]['selected_items'], 'foundation_listing') !== false) {
              $itemContent .= '<td>'.$listNumber.'</td>';
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_title') !== false) {
              $itemContent .= '<td>'.substr($dropdown['title'], 0, $dropDownInfos[0]['title_crop']).'</td>';
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_text') !== false) {
              $itemContent .= '<td>'.strip_tags(substr($dropdown['text'], 0, $dropDownInfos[0]['text_crop'])).'</td>';
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_files') !== false) {
              $itemContent .= '<td>'.$fileExist.'</td>';
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_hover') !== false) {
              $itemContent .= '<td>'.($dropdown['hover']===1 ? '&#10004; </td>' : '&#10008; </td>');
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_position') !== false) {
              $itemContent .= '<td>'.$dropdown['position'].'</td>';
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_alignment') !== false) {
              $itemContent .= '<td>'.$dropdown['alignment'].'</td>';
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_hover_panel') !== false) {
              $itemContent .= '<td>'.($dropdown['hover_panel']===1 ? '&#10004; </td>' : '&#10008; </td>');
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_allow_bottom_overlap') !== false) {
              $itemContent .= '<td>'.($dropdown['allow_bottom_overlap']===1 ? '&#10004; </td>' : '&#10008; </td>');
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_trap_focus') !== false) {
              $itemContent .= '<td>'.($dropdown['trap_focus']===1 ? '&#10004; </td>' : '&#10008; </td>');
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_auto_focus') !== false) {
              $itemContent .= '<td>'.($dropdown['auto_focus']===1 ? '&#10004; </td>' : '&#10008; </td>');
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_v_offset') !== false) {
              $itemContent .= '<td>'.$dropdown['v_offset'].'</td>';
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_h_offset') !== false) {
              $itemContent .= '<td>'.$dropdown['h_offset'].'</td>';
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_close_on_click') !== false) {
              $itemContent .= '<td>'.($dropdown['close_on_click']===1 ? '&#10004; </td>' : '&#10008; </td>');
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_container') !== false) {
              $itemContent .= '<td>'.($dropdown['container']===1 ? '&#10004; </td>' : '&#10008; </td>');
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_color') !== false) {
              $itemContent .= '<td>'.$dropdown['color'].'</td>';
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_size') !== false) {
              $itemContent .= '<td>'.$dropdown['size'].'</td>';
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_hollow') !== false) {
              $itemContent .= '<td>'.$dropdown['hollow'].'</td>';
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_clear') !== false) {
              $itemContent .= '<td>'.$dropdown['clear'].'</td>';
            }
            if (strpos($dropDownInfos[0]['selected_items'], 'dropdown_disabled') !== false) {
              $itemContent .= '<td>'.$dropdown['disabled'].'</td>';
            }
          $itemContent .= '</tr>';
        }

      } elseif ($dropDownInfos[0]['selected_items'] != 1 && $dropDownInfos[0]['hide_content']) {
        
      } else {
        $itemContent .= '<tr>';
          $itemContent .= '<th class="listing"></th>';
          $itemContent .= '<th>Title</th>';
          $itemContent .= '<th>Text</th>';
          $itemContent .= '<th>Position</th>';
          $itemContent .= '<th>Aligment</th>';
          $itemContent .= '<th>Hover</th>';
        $itemContent .= '</tr>';
        $listNumber = 0;
        foreach (array_slice($dropDownInfos, 0, $dropDownInfos[0]['limit_content']) as $dropdown) {
          $listNumber++;
          $itemContent .= '<tr>';
          $itemContent .= '<td>'.$listNumber .'.</td>';
          $itemContent .= '<td>'.substr($dropdown['title'], 0, $dropDownInfos[0]['title_crop']).'</td>';
          $itemContent .= '<td>'.strip_tags(substr($dropdown['text'], 0, $dropDownInfos[0]['text_crop'])).'</td>';
          $itemContent .= '<td>'.$dropdown['position'].'</td>';
          $itemContent .= '<td>'.$dropdown['alignment'].'</td>';
          $itemContent .= '<td>'.($dropdown['hover']===1 ? '&#10004; </td>' : '&#10008; </td>');
          $itemContent .= '</tr>';
        }

      }
       $itemContent .= '</tbody>';
      $itemContent .= '</table>';
      $drawItem = false;
    }
  }
}