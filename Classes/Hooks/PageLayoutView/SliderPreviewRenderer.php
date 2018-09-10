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
    $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_slidersettings');
    $sliderHideArrow = $queryBuilder
        ->select('hide_arrows')
        ->from('foundation_zurb_slidersettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['slider_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $sliderHideBullets = $queryBuilder
        ->select('hide_bullets')
        ->from('foundation_zurb_slidersettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['slider_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $sliderAutoPlay = $queryBuilder
        ->select('auto_play')
        ->from('foundation_zurb_slidersettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['slider_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $sliderInfiniteWrap = $queryBuilder
        ->select('infinite_wrap')
        ->from('foundation_zurb_slidersettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['slider_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $sliderSwipe = $queryBuilder
        ->select('swipe')
        ->from('foundation_zurb_slidersettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['slider_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $sliderPauseOnHover = $queryBuilder
        ->select('pause_on_hover')
        ->from('foundation_zurb_slidersettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['slider_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $sliderAccess = $queryBuilder
        ->select('accessible_buttons')
        ->from('foundation_zurb_slidersettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['slider_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $sliderMui = $queryBuilder
        ->select('use_m_u_i')
        ->from('foundation_zurb_slidersettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['slider_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $sliderInLeft = $queryBuilder
        ->select('slide_direction_in_left')
        ->from('foundation_zurb_slidersettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['slider_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $sliderOutLeft = $queryBuilder
        ->select('slide_direction_out_left')
        ->from('foundation_zurb_slidersettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['slider_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $sliderOutRight = $queryBuilder
        ->select('slide_direction_out_right')
        ->from('foundation_zurb_slidersettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['slider_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $sliderInRight = $queryBuilder
        ->select('slide_direction_in_right')
        ->from('foundation_zurb_slidersettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['slider_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $sliderTimerDelay = $queryBuilder
        ->select('timer_delay')
        ->from('foundation_zurb_slidersettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['slider_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    
    if ($row['CType'] === 'foundation_slider') {
      $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
      $itemContent .= '<table class="foundation_table">';
      $itemContent .= '<tbody>';
      $itemContent .= ($sliderHideArrow ===1 ? '<tr><th>Hide arrows</th> <td> &#10004;</td>' : '<tr><th>Hide arrows</th> <td> &#10008;</td>');
      $itemContent .= ($sliderHideBullets ===1 ? '<th>Hide bullets</th> <td> &#10004;</td></tr>' : '<th>Hide bullets</th> <td> &#10008;</td></tr>');
      $itemContent .= ($sliderAutoPlay ===1 ? '<tr><th>Disable auto play</th> <td> &#10004;</td>' : '<tr><th>Disable auto play</th> <td> &#10008;</td>');
      $itemContent .= ($sliderInfiniteWrap ===1 ? '<th>Disable infinite wrap</th> <td> &#10004;</td></tr>' : '<th>Disable infinite wrap</th> <td> &#10008;</td></tr>');
      $itemContent .= ($sliderSwipe ===1 ? '<tr><th>Disable swipe</th> <td> &#10004;</td>' : '<tr><th>Disable swipe</th> <td> &#10008;</td>');
      $itemContent .= ($sliderPauseOnHover ===1 ? '<th>Disable pause on hover</th> <td> &#10004;</td></tr>' : '<th>Disable pause on hover</th> <td> &#10008;</td></tr>');
      $itemContent .= ($sliderAccess ===1 ? '<tr><th>Disable keyboard navigation</th> <td> &#10004;</td>' : '<tr><th>Disable keyboard navigation</th> <td> &#10008;</td>');
      $itemContent .= ($sliderMui ===1 ? '<th>Disable MUI</th> <td> &#10004;</td></tr>' : '<th>Disable MUI</th> <td> &#10008;</td></tr>');
      $itemContent .= '</tbody>';
      $itemContent .= '</table>';
      $itemContent .= '<strong class="foundation_subtitle">Animations</strong>';
      $itemContent .= '<table class="foundation_table">';
        $itemContent .= '<tbody>';
          $itemContent .= '<tr><th>Animation in left</th> <td> '.$sliderInLeft .'</td>';
          $itemContent .= '<th>Animation out left</th> <td>'.$sliderOutLeft .'</td></tr>';
          $itemContent .= '<tr><th>Animation in right</th> <td> '.$sliderInRight .'</td>';
          $itemContent .= '<th>Animation out right</th> <td>'.$sliderOutRight .'</td></tr>';
        $itemContent .= '</tbody>';
      $itemContent .= '</table>';
      
      $itemContent .= '<strong class="foundation_subtitle">Timings</strong>';
      $itemContent .= '<table class="foundation_table">';
      $itemContent .= '<tbody>';
      $itemContent .= '<tr><th>Timer Delay in ms</th> <td> '.$sliderTimerDelay .'</td></tr>';
      $itemContent .= '</tbody>';
      $itemContent .= '</table>';
      $drawItem = false;
      }
   }
}