<?php

/**
 * @package   BackendHelper
 * @author    Sebastian Buck
 * @license   LGPL
 * @copyright Sebastian Buck, 2017
 */


namespace Bastibuck\BackendHelper\Resources\Backend;

use Contao\Backend;
use Contao\Input;
use Contao\Database;
use Contao\Environment;
use Contao\Date;
use Contao\Config;

class BackendUtils extends Backend {

  /**
	 * List a content element including it's ID
	 *
	 * @param array $arrRow
	 * @return string
	 */
	public function listContentWithID($arrRow)
	{
    // load original function and manipulate content
    $objOriginalFunctions = new \tl_content();
    $strOriginalOutput = $objOriginalFunctions->addCteType($arrRow);

    return $this->addIDtoListElement($strOriginalOutput, $arrRow);
	}

  /**
	 * List news element including it's ID
	 *
	 * @param array $arrRow
	 * @return string
	 */
	public function listNewsArticlesWithIDs($arrRow)
	{
    // load original function and manipulate content
    $objOriginalFunctions = new \tl_news();
    $strOriginalOutput = $objOriginalFunctions->listNewsArticles($arrRow);

    return $this->addIDtoListElement($strOriginalOutput, $arrRow);
	}

  /**
	 * List a front end module including it's ID
	 *
	 * @param array $arrRow
	 * @return string
	 */
	public function listModuleWithID($arrRow)
	{
    // load original function and manipulate content
    $objOriginalFunctions = new \tl_module();
    $strOriginalOutput = $objOriginalFunctions->listModule($arrRow);

    return $this->addIDtoListElement($strOriginalOutput, $arrRow);
	}

  /**
	 * List an event including it's ID
	 *
	 * @param array $arrRow
	 * @return string
	 */
	public function listEventsWithID($arrRow)
	{
    // load original function and manipulate content
    $objOriginalFunctions = new \tl_calendar_events();
    $strOriginalOutput = $objOriginalFunctions->listEvents($arrRow);

    return $this->addIDtoListElement($strOriginalOutput, $arrRow);
	}

  /**
	 * List a faq question including it's ID
	 *
	 * @param array $arrRow
	 * @return string
	 */
	public function listQuestionsWithID($arrRow)
	{
    // load original function and manipulate content
    $objOriginalFunctions = new \tl_faq();
    $strOriginalOutput = $objOriginalFunctions->listQuestions($arrRow);

    return $this->addIDtoListElement($strOriginalOutput, $arrRow);
	}

  /**
	 * List a form field including it's ID
	 *
	 * @param array $arrRow
	 * @return string
	 */
	public function listFormFieldsWithID($arrRow)
	{
    // load original function and manipulate content
    $objOriginalFunctions = new \tl_form_field();
    $strOriginalOutput = $objOriginalFunctions->listFormFields($arrRow);

    return $this->addIDtoListElement($strOriginalOutput, $arrRow);
	}

  /**
	 * List a newsletter including it's ID
	 *
	 * @param array $arrRow
	 * @return string
	 */
	public function listNewslettersWithID($arrRow)
	{
    // load original function and manipulate content
    $objOriginalFunctions = new \tl_newsletter();
    $strOriginalOutput = $objOriginalFunctions->listNewsletters($arrRow);

    return $this->addIDtoListElement($strOriginalOutput, $arrRow);
	}

  /**
	 * List a comment including it's ID
	 *
	 * @param array $arrRow
	 * @return string
	 */
	public function listCommentsWithID($arrRow)
	{

    // load original function and manipulate content
    $objOriginalFunctions = new \tl_comments();
    $strOriginalOutput = $objOriginalFunctions->listComments($arrRow);

    return $this->addIDtoListElement($strOriginalOutput, $arrRow);
	}





  /**
	 * adds ID to a listing of
   *      - content elements
   *      - news
   *      - modules
   *      - calendar_events
   *      - faq questions
   *      - form fields
   *      - newsletter
   *      - comments
	 *
	 * @param array $strOriginalOutput, array $arrRow
	 * @return string
	 */
  public function addIDtoListElement($strOriginalOutput, $arrRow) {

    // prepare addition HTML markup
    $strAddSpanID = '<span class="be_ID_container">[ID: '.$arrRow['id'].']</span>';

    // add ID to output
    $haystack = $strOriginalOutput;
    $needle = '</div>';
    $replace = $strAddSpanID.$needle;

    $pos = strpos($haystack, $needle);
    if ($pos !== false) {
        $strNewOutput = substr_replace($haystack, $replace, $pos, strlen($needle));
    }

    // remove float from parent div
    $haystack = $strNewOutput;
    $needle = '<div style="float:left">';
    $replace = '<div>';

    $strNewOutput = str_replace ($needle, $replace, $haystack);

    return $strNewOutput;
  }



  /**
 	 * show where a given module is included
 	 *
 	 * @return string
 	 */
 	public function showUsage()
 	{
    // init
    $return = '';
    $strParentChildSeparator = ' » ';
    $backendPath = '/contao/main.php';

    // build info header
    $id = Input::get('id'); // module ID
    $arrInfoRow = array();

    // get module data
    $objModule = Database::getInstance()
      ->prepare('SELECT * FROM tl_module WHERE id=?')
      ->execute($id);

    $arrInfoRow['type'] = $GLOBALS['TL_LANG']['FMD'][$objModule->type][0];
    $arrInfoRow['name'] = $objModule->name;

    $return .= '<div class="tl_show module_usage_headline">
                  <h1>
                    '.$objModule->name.' <span style="color:#999;padding-left:3px; font-weight: 300;">['.$GLOBALS['TL_LANG']['FMD'][$objModule->type][0].']</span>
                  </h1>
                </div>';


    // look for includes in layouts
    $objLayouts = Database::getInstance()
      ->prepare('SELECT * FROM tl_layout')
      ->execute();

    while($objLayouts->next()) {
      $arrModules = deserialize($objLayouts->modules);

      foreach($arrModules as $module) {
        if ($module['mod'] == $id) {
          $arrIncluded['tl_layout'][] = '<a href="'.$backendPath.'?do=themes&table=tl_layout&id='.$objLayouts->id.'&act=edit&popup=1&rt='.REQUEST_TOKEN.'">'.$objLayouts->name.'</a>';
        }
      }
    }

    // look for includes in content elements
    $objContent = Database::getInstance()
      ->prepare('SELECT * FROM tl_content WHERE type=?')
      ->execute('module');

    while($objContent->next()) {
      if($objContent->module == $id) {

        switch ($objContent->ptable) {

          // News
          case 'tl_news':
            $strDo = 'news';

            // get parent news
            $objNews = Database::getInstance()
              ->prepare('SELECT * FROM '.$objContent->ptable.' WHERE id=?')
              ->execute($objContent->pid);

            // get parent news archive
            $objNewsArchive = Database::getInstance()
              ->prepare('SELECT * FROM tl_news_archive WHERE id=?')
              ->execute($objNews->pid);

            // build value string
            $strParent = $objNewsArchive->title.$strParentChildSeparator;
            $strValue = $objNews->headline.'<span style="color:#999;padding-left:3px">[' .Date::parse(Config::get('datimFormat'), $objNews->date) . ']';
            break;

          // Article
          case 'tl_article':
            $strDo = 'article';

            // get parent article
            $objArticle = Database::getInstance()
              ->prepare('SELECT * FROM '.$objContent->ptable.' WHERE id=?')
              ->execute($objContent->pid);

            // get parent page
            $objPage = Database::getInstance()
              ->prepare('SELECT * FROM tl_page WHERE id=?')
              ->execute($objArticle->pid);

            // build value string
            $strParent = $objPage->title.$strParentChildSeparator;
            $strValue = $objArticle->title.'<span style="color:#999;padding-left:3px">['.$GLOBALS['TL_LANG']['COLS'][$objArticle->inColumn].']</span>';

            break;

          // Calendar
          case 'tl_calendar_events':
            $strDo = 'calendar';

            // get parent event
            $objEvent = Database::getInstance()
              ->prepare('SELECT * FROM '.$objContent->ptable.' WHERE id=?')
              ->execute($objContent->pid);

            // get parent calendar
            $objCalendar = Database::getInstance()
              ->prepare('SELECT * FROM tl_calendar WHERE id=?')
              ->execute($objEvent->pid);

            // build value string
            $strParent = $objCalendar->title.$strParentChildSeparator;
            $strValue = $objEvent->title.'<span style="color:#999;padding-left:3px">[' .Date::parse(Config::get('datimFormat'), $objEvent->date) . ']';
            break;
        }



        $arrIncluded[$objContent->ptable][] = $strParent.'<a href="'.$backendPath.'?do='.$strDo.'&table=tl_content&id='.$objContent->pid.'&popup=1&rt='. REQUEST_TOKEN.'">'.$strValue.'</a>';
      }
    }

    // reorder array
    if($arrIncluded) {
      $sortArray = array();
      if($arrIncluded['tl_layout']) {
        $sortArray[] = 'tl_layout';
      }
      if($arrIncluded['tl_article']) {
        $sortArray[] = 'tl_article';
      }
      if($arrIncluded['tl_news']) {
        $sortArray[] = 'tl_news';
      }
      if($arrIncluded['tl_calendar_events']) {
        $sortArray[] = 'tl_calendar_events';
      }
      $arrIncluded = array_merge(array_flip($sortArray), $arrIncluded);


      // build containers
      foreach ($arrIncluded as $key => $arrElement) {

        $strModName = str_replace('tl_', '', $key);
        switch ($strModName) {
          case 'article':
          case 'news':
            $strModName = $GLOBALS['TL_LANG']['MOD'][$strModName][0];
            break;

          case 'calendar_events':
            $strModName = $GLOBALS['TL_LANG']['MOD']['calendar'][0];
            break;

          case 'layout':
            $strModName = $GLOBALS['TL_LANG']['MOD'][$strModName];
            break;

          default:
            # code...
            break;
        }

        // headline
        $return .= '<div class="module_usage module_usage_'.$key.'">
        <table class="tl_show"><tr><th>'.$strModName.'</th></tr>';

        // rows
        $count = 0;
        foreach ($arrElement as $value) {
          $class = (($count++ % 2) == 0) ? ' class="tl_bg"' : '';

          $return .= '
          <tr>
            <td'.$class.'>'.$value.'</td>
          </tr>';
        }

        $return .= '</table></div>';
      }
    }
    else {
      $return .= '<div class="tl_show"><h3 style="color: #589b0e;">'.$GLOBALS['TL_LANG']['MSC']['module_usage']['module_not_used'].'</h3>';
      $return .= '<p style="margin: 1em 0; font-style: italic;">'.$GLOBALS['TL_LANG']['MSC']['module_usage']['module_not_used_tip'].'</p></div>';
    }



    // return HTML table
    return $return;
  }
}
