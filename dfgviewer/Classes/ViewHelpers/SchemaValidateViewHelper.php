<?php
namespace Slub\Dfgviewer\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Alexander Bigga <alexander.bigga@slub-dresden.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * ViewHelper to get page info
 *
 * # Example: Basic example
 * <code>
 * <si:pageInfo page="123">
 *	<span>123</span>
 * </code>
 * <output>
 * Will output the page record
 * </output>
 *
 * @package TYPO3
 */
class SchemaValidateViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Return elements found
     *
     * @param string $id uri to METS-file
     * @return mixed boolean|array
     */
    public function render($id)
    {
      $is_valid_xml = FALSE;

      // Enable user error handling
      libxml_use_internal_errors(true);

      $dom = new \DOMDocument;
      $dom->load($id);
      $is_valid_xml = $dom->schemaValidate('typo3conf/ext/dfgviewer/Resources/Private/Schema/metsmods.xsd');

      if (!$is_valid_xml) {
        $errors = libxml_get_errors();
        libxml_clear_errors();
        return $errors;
      }

      return $is_valid_xml;
    }
}
