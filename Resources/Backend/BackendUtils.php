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
 	 * Return all non-excluded fields of a record as HTML table
 	 *
 	 * @return string
 	 */
 	public function showUsage()
 	{
    $arrRows = array();
    $count = 0;

    // module ID
    $id = Input::get('id');

    // get module
    $objModule = Database::getInstance()
      ->prepare('SELECT * FROM tl_module WHERE id=?')
      ->execute($id);

    $arrRows['type'] = $GLOBALS['TL_LANG']['FMD'][$objModule->type][0];
    $arrRows['name'] = $objModule->name;

    foreach ($arrRows as $key => $value) {

      // create colored rows
      $class = (($count++ % 2) == 0) ? ' class="tl_bg"' : '';

      $return .= '
      <tr>
        <td'.$class.'>
          <span class="tl_label">
            '.$GLOBALS['TL_LANG']['tl_module'][$key][0].'
          </span>
        </td>
        <td'.$class.'>'.$value.'</td>
      </tr>';
    }

    // return HTML table
    return '
      <table class="tl_show">
        '.$return.'
      </table>';
  }
}
