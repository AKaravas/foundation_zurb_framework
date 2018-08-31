<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;

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
    $sliderHideArrow = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_slidersettings', $row['slider_settings_relation'], 'hide_arrows');
    $sliderHideBullets = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_slidersettings', $row['slider_settings_relation'], 'hide_bullets');
    $sliderAutoPlay = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_slidersettings', $row['slider_settings_relation'], 'auto_play');
    $sliderInfiniteWrap = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_slidersettings', $row['slider_settings_relation'], 'infinite_wrap');
    $sliderSwipe = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_slidersettings', $row['slider_settings_relation'], 'swipe');
    $sliderPauseOnHover = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_slidersettings', $row['slider_settings_relation'], 'pause_on_hover');
    $sliderAccess = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_slidersettings', $row['slider_settings_relation'], 'accessible_buttons');
    $sliderMui = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_slidersettings', $row['slider_settings_relation'], 'use_m_u_i');
    $sliderInLeft = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_slidersettings', $row['slider_settings_relation'], 'slide_direction_in_left');
    $sliderOutLeft = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_slidersettings', $row['slider_settings_relation'], 'slide_direction_out_left');
    $sliderOutRight = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_slidersettings', $row['slider_settings_relation'], 'slide_direction_out_right');
    $sliderInRight = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_slidersettings', $row['slider_settings_relation'], 'slide_direction_in_right');
    $sliderTimerDelay = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_slidersettings', $row['slider_settings_relation'], 'timer_delay');
    
    if ($row['CType'] === 'foundation_slider') {
      $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
      $itemContent .= '<table class="foundation_table">';
      $itemContent .= '<tbody>';
      $itemContent .= ($sliderHideArrow['hide_arrows']===1 ? '<tr><th>Hide arrows</th> <td> &#10004;</td>' : '<tr><th>Hide arrows</th> <td> &#10008;</td>');
      $itemContent .= ($sliderHideBullets['hide_bullets']===1 ? '<th>Hide bullets</th> <td> &#10004;</td></tr>' : '<th>Hide bullets</th> <td> &#10008;</td></tr>');
      $itemContent .= ($sliderAutoPlay['auto_play']===1 ? '<tr><th>Disable auto play</th> <td> &#10004;</td>' : '<tr><th>Disable auto play</th> <td> &#10008;</td>');
      $itemContent .= ($sliderInfiniteWrap['infinite_wrap']===1 ? '<th>Disable infinite wrap</th> <td> &#10004;</td></tr>' : '<th>Disable infinite wrap</th> <td> &#10008;</td></tr>');
      $itemContent .= ($sliderSwipe['swipe']===1 ? '<tr><th>Disable swipe</th> <td> &#10004;</td>' : '<tr><th>Disable swipe</th> <td> &#10008;</td>');
      $itemContent .= ($sliderPauseOnHover['pause_on_hover']===1 ? '<th>Disable pause on hover</th> <td> &#10004;</td></tr>' : '<th>Disable pause on hover</th> <td> &#10008;</td></tr>');
      $itemContent .= ($sliderAccess['accessible_buttons']===1 ? '<tr><th>Disable keyboard navigation</th> <td> &#10004;</td>' : '<tr><th>Disable keyboard navigation</th> <td> &#10008;</td>');
      $itemContent .= ($sliderMui['use_m_u_i']===1 ? '<th>Disable MUI</th> <td> &#10004;</td></tr>' : '<th>Disable MUI</th> <td> &#10008;</td></tr>');
      $itemContent .= '</tbody>';
      $itemContent .= '</table>';
      $itemContent .= '<strong class="foundation_subtitle">Animations</strong>';
      $itemContent .= '<table class="foundation_table">';
        $itemContent .= '<tbody>';
          $itemContent .= '<tr><th>Animation in left</th> <td> '.$sliderInLeft['slide_direction_in_left'].'</td>';
          $itemContent .= '<th>Animation out left</th> <td>'.$sliderOutLeft['slide_direction_out_left'].'</td></tr>';
          $itemContent .= '<tr><th>Animation in right</th> <td> '.$sliderInRight['slide_direction_in_right'].'</td>';
          $itemContent .= '<th>Animation out right</th> <td>'.$sliderOutRight['slide_direction_out_right'].'</td></tr>';
        $itemContent .= '</tbody>';
      $itemContent .= '</table>';
      
      $itemContent .= '<strong class="foundation_subtitle">Timings</strong>';
      $itemContent .= '<table class="foundation_table">';
      $itemContent .= '<tbody>';
      $itemContent .= '<tr><th>Timer Delay in ms</th> <td> '.$sliderTimerDelay['timer_delay'].'</td></tr>';
      $itemContent .= '</tbody>';
      $itemContent .= '</table>';
      $drawItem = false;
      }
   }
}