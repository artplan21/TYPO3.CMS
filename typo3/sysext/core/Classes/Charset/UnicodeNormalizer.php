<?php
namespace TYPO3\CMS\Core\Charset;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Stephan Jorek <stephan.jorek@artplan21.de>
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
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

if (!extension_loaded('intl')) {
	throw new \TYPO3\CMS\Core\Exception('Missing php\'s “intl” extension.', 1398597475);
}

if (!class_exists('\\Normalizer', false)) {
	throw new \TYPO3\CMS\Core\Exception('Missing unicode normalization implementation class.', 1398597477);
}

/**
 * Class for normalizing unicode. This implementation is a simple facade to “php-intl” extension's “Normalizer”-class.
 *
 * @author Stephan Jorek <stephan.jorek@artplan21.de>
 * @see http://forge.typo3.org/issues/57695
 * @see http://www.php.net/manual/en/class.normalizer.php
 * @see http://en.wikipedia.org/wiki/Unicode_equivalence
 * @see http://stackoverflow.com/questions/7931204/what-is-normalized-utf-8-all-about
 */
class UnicodeNormalizer {

	/**
	 * A string indicating which unicode normalization form to use. Must be set to one of the following constants:
	 * \Normalizer::FORM_C, \Normalizer::FORM_D, \Normalizer::FORM_KC, \Normalizer::FORM_KD or \Normalizer::NONE
	 *
	 * @var string
	 */
	protected $form = NULL;

	/**
	 * @param string $form Set the default normalization form to one of the available constants; \Normalizer::NONE is default.
	 * @see http://www.php.net/manual/en/class.normalizer.php
	 */
	public function __construct($form = NULL) {
		$this->form = $form ?: \Normalizer::NONE;
	}

	/**
	 * Checks if the provided string is already in the specified or current default normalization form.
	 *
	 * @param string $input The string to check.
	 * @param string $form An optional normalization form to check against, overriding the default; see constructor.
	 * @return boolean TRUE if normalized, FALSE otherwise or if an error occurred.
	 */
	public function isNormalized($input, $form = NULL) {
		return \Normalizer::isNormalized($input, $form ?: $this->form);
	}

	/**
	 * Normalizes the input provided and returns the normalized string.
	 *
	 * @param string $input The string to normalize.
	 * @param string $form An optional normalization form to check against, overriding the default; see constructor.
	 * @return string|NULL The normalized string or NULL if an error occurred.
	 */
	public function normalize($input, $form = NULL) {
		return \Normalizer::normalize($input, $form ?: $this->form);
	}
}
