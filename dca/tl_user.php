<?php

/**
 * @package   BackendHelper
 * @author    Sebastian Buck
 * @license   LGPL
 * @copyright Sebastian Buck, 2017
 */


// get logged in user
$objUser = BackendUser::getInstance();

 // show ID for pages in listing
if ($objUser->showListingIDs && ('tl_user', $objUser->showListingIDs)) {
  $GLOBALS['TL_DCA']['tl_user']['list']['label']['fields'][] = 'id';
  $GLOBALS['TL_DCA']['tl_user']['fields']['id']['label'] = &$GLOBALS['TL_LANG']['MSC']['id'];
}


// Adjust palettes
foreach ($GLOBALS['TL_DCA']['tl_user']['palettes'] as $k => $palette) {
  if (!is_array($palette) && strpos($palette, "useCE")!==false) {
    $GLOBALS['TL_DCA']['tl_user']['palettes'][$k] = str_replace (
      'useCE',
      'useCE;{backendhelper_legend:hide},useQuickLink,showListingIDs',
      $GLOBALS['TL_DCA']['tl_user']['palettes'][$k]
    );
  }
}

// Add fields
$GLOBALS['TL_DCA']['tl_user']['fields']['useQuickLink'] = array (
  'label'                   => &$GLOBALS['TL_LANG']['tl_user']['useQuickLink'],
  'default'                 => 0,
  'exclude'                 => true,
  'inputType'               => 'checkbox',
  'eval'                    => array('tl_class'=>'w50'),
  'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_user']['fields']['showListingIDs'] = array (
  'label'                   => &$GLOBALS['TL_LANG']['tl_user']['showListingIDs'],
  'exclude'                 => true,
  'filter'                  => true,
  'inputType'               => 'checkbox',
  'options'                 => array(
    'tl_article',
    'tl_content',
    'tl_news_archive',
    'tl_news',
    'tl_calendar',
    'tl_calendar_events',
    'tl_faq_category',
    'tl_faq',
    'tl_newsletter_channel',
    'tl_newsletter',
    'tl_form',
    'tl_form_field',
    'tl_comments',
    'tl_module',
    'tl_page',
    'tl_member',
    'tl_member_group',
    'tl_user',
    'tl_user_group'
  ),
  'eval'                    => array('multiple'=>true, 'tl_class' => 'clr m12'),
  'sql'                     => "blob NULL"
);
