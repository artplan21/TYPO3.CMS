<?php
namespace TYPO3\CMS\Frontend\Hooks;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Stephan Jorek (stephan.jorek@artplan21.de)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the text file GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Charset\UnicodeNormalizer;
use TYPO3\CMS\Core\Utility\HttpUtility;

/**
 * Unicode-Normalization related hooks
 *
 * @author Stephan Jorek <stephan.jorek@artplan21.de>
 */
class UnicodeNormalizationHooks {

	/**
	 * Hook to redirect to unicode-nomalized request-uri if needed
	 *
	 * @param array $params
	 * @param \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $pObj
	 * @return string
	 */
	public function hook_redirectRequestUriIfNeeded($params, \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $pObj) {
		$uri = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('REQUEST_URI');
		if ($uri) {
			$normalizedUri = UnicodeNormalizer::filterUri($uri);
			if ($normalizedUri !== '' && $normalizedUri !== $uri) {
				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					// FIXME this redirect will break any data-submissions
					$headerCode = HttpUtility::HTTP_STATUS_303;
				} else {
					$headerCode = HttpUtility::HTTP_STATUS_301;
				}
				$url = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_REQUEST_HOST') . $normalizedUri;
				HttpUtility::redirect($url, $headerCode);
			}
		}
	}

}
