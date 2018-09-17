<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;

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
   )
   {
    if ($row['CType'] === 'foundation_slider') {

      $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_slidersettings');
      $sliderSettings = $queryBuilder
        ->select('hide_arrows', 'hide_bullets', 'auto_play', 'infinite_wrap', 'swipe', 'pause_on_hover', 'timer_delay', 'slide_direction_in_right', 'slide_direction_out_right', 'slide_direction_out_left', 'slide_direction_in_left', 'use_m_u_i', 'accessible_buttons')
        ->from('foundation_zurb_slidersettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['slider_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchAll();

      $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
      $itemContent .= '<table class="foundation_table">';
      $itemContent .= '<tbody>';
      $itemContent .= ($sliderSettings[0]['hide_arrows'] ===1 ? '<tr><th>Hide arrows</th> <td> &#10004;</td>' : '<tr><th>Hide arrows</th> <td> &#10008;</td>');
      $itemContent .= ($sliderSettings[0]['hide_bullets'] ===1 ? '<th>Hide bullets</th> <td> &#10004;</td></tr>' : '<th>Hide bullets</th> <td> &#10008;</td></tr>');
      $itemContent .= ($sliderSettings[0]['auto_play'] ===1 ? '<tr><th>Disable auto play</th> <td> &#10004;</td>' : '<tr><th>Disable auto play</th> <td> &#10008;</td>');
      $itemContent .= ($sliderSettings[0]['infinite_wrap'] ===1 ? '<th>Disable infinite wrap</th> <td> &#10004;</td></tr>' : '<th>Disable infinite wrap</th> <td> &#10008;</td></tr>');
      $itemContent .= ($sliderSettings[0]['swipe'] ===1 ? '<tr><th>Disable swipe</th> <td> &#10004;</td>' : '<tr><th>Disable swipe</th> <td> &#10008;</td>');
      $itemContent .= ($sliderSettings[0]['pause_on_hover'] ===1 ? '<th>Disable pause on hover</th> <td> &#10004;</td></tr>' : '<th>Disable pause on hover</th> <td> &#10008;</td></tr>');
      $itemContent .= ($sliderSettings[0]['accessible_buttons'] ===1 ? '<tr><th>Disable keyboard navigation</th> <td> &#10004;</td>' : '<tr><th>Disable keyboard navigation</th> <td> &#10008;</td>');
      $itemContent .= ($sliderSettings[0]['use_m_u_i'] ===1 ? '<th>Disable MUI</th> <td> &#10004;</td></tr>' : '<th>Disable MUI</th> <td> &#10008;</td></tr>');
      $itemContent .= '</tbody>';
      $itemContent .= '</table>';
      $itemContent .= '<strong class="foundation_subtitle">Animations</strong>';
      $itemContent .= '<table class="foundation_table">';
        $itemContent .= '<tbody>';
          $itemContent .= '<tr><th>Animation in left</th> <td> '.$sliderSettings[0]['slide_direction_in_left'].'</td>';
          $itemContent .= '<th>Animation out left</th> <td>'.$sliderSettings[0]['slide_direction_out_left'] .'</td></tr>';
          $itemContent .= '<tr><th>Animation in right</th> <td> '.$sliderSettings[0]['slide_direction_in_right'] .'</td>';
          $itemContent .= '<th>Animation out right</th> <td>'.$sliderSettings[0]['slide_direction_out_right'] .'</td></tr>';
        $itemContent .= '</tbody>';
      $itemContent .= '</table>';
      
      $itemContent .= '<strong class="foundation_subtitle">Timings</strong>';
      $itemContent .= '<table class="foundation_table">';
      $itemContent .= '<tbody>';
      $itemContent .= '<tr><th>Timer Delay in ms</th> <td> '.$sliderSettings[0]['timer_delay'] .'</td></tr>';
      $itemContent .= '</tbody>';
      $itemContent .= '</table>';
      $drawItem = false;
      }
   }
}