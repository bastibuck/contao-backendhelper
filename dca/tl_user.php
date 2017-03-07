<?php

/**
 * @package   BackendHelper
 * @author    Sebastian Buck
 * @license   LGPL
 * @copyright Sebastian Buck, 2017
 */


// Adjust palettes
foreach ($GLOBALS['TL_DCA']['tl_user']['palettes'] as $k => $palette) {
  if (!is_array($palette) && strpos($palette, "useCE")!==false) {
    $GLOBALS['TL_DCA']['tl_user']['palettes'][$k] = str_replace (
      'useCE',
      'useCE,useQuickLink',
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
