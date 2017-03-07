<?php

/**
 * @package   BackendHelper
 * @author    Sebastian Buck
 * @license   LGPL
 * @copyright Sebastian Buck, 2017
 */


namespace Bastibuck\BackendHelper\Resources\Backend;

use Contao\Template;
use Contao\BackendUser;


/**
 * Hooks
 */
class Hooks {

  public function addInstallToolLink($strContent, $strTemplate)
  {
      if ($strTemplate == 'be_main')
      {
        $objUser = BackendUser::getInstance();

        // check if quicklink should be used
        if ($objUser->useQuickLink || $objUser->isAdmin) {

          // Build
          $strLinkText = $GLOBALS['TL_LANG']['MSC']['quick_installtool']['text'];
          $strLinkTitle = $GLOBALS['TL_LANG']['MSC']['quick_installtool']['title'];

          $strFind = '<ul id="tmenu">';
          $strHTML = '<li><a href="'.Template::route('contao_backend').'/install" class="icon-install" title="'.$strLinkTitle.'">'.$strLinkText.'</a></li>';

          // add quickLink to header
          $strContent = str_replace($strFind, $strFind.$strHTML, $strContent);
        }

      }

      return $strContent;
  }
}
