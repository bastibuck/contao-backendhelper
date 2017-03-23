<?php

/**
 * @package   BackendHelper
 * @author    Sebastian Buck
 * @license   LGPL
 * @copyright Sebastian Buck, 2017
 */


namespace Bastibuck\BackendHelper\Resources\Backend;

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
        if ($objUser->useQuickLink) {

          // Build
          $strLinkText = $GLOBALS['TL_LANG']['MSC']['quick_installtool']['text'];
          $strLinkTitle = $GLOBALS['TL_LANG']['MSC']['quick_installtool']['title'];

          $strFind = '<ul id="tmenu">'; // contao 4
          if(strpos($strContent, $strFind)) {

            $strURL = \Template::route('contao_backend');

            $strHTML = '<li><a href="'.$strURL.'/install" class="icon-install" title="'.$strLinkTitle.'">'.$strLinkText.'</a></li>';
            $strContent = str_replace($strFind, $strFind.$strHTML, $strContent);
          }
          else {
            $strFind = '<div id="tmenu">'; // contao 3.5

            $strURL = \Environment::get('url').'/contao';

            $strHTML = '<span class="header_quicklink_container"><a href="'.$strURL.'/install.php" class="header_install" title="'.$strLinkTitle.'" target="_blank">'.$strLinkText.'</a></span>';
            $strContent = str_replace($strFind, $strFind.$strHTML, $strContent);
          }
        }
      }

      return $strContent;
  }
}
