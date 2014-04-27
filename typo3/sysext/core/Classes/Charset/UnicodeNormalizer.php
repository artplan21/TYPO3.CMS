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
	 * @var integer
	 */
	protected $normalization = NULL;

	/**
	 * A falg indicating which normalizer to use - TRUE means use intl's Normalizer, FALSE or NULL
	 *
	 * @var boolean
	 */
	protected $useIntlNormalizer = NULL;

	/**
	 * @param integer $normalization Set the default normalization form to one of the available constants; \Normalizer::NONE is default.
	 * @see http://www.php.net/manual/en/class.normalizer.php
	 */
	public function __construct($normalization = NULL) {
		$this->useIntlNormalizer = (boolean) ($GLOBALS['TYPO3_CONF_VARS']['SYS']['unicodeNormalizer'] === 'intl');

		if ($normalization === NULL) {
			$normalization = $this->useIntlNormalizer ? \Normalizer::NONE : self::NONE;
		}
		$this->setNormalizationForm($normalization);
	}

	/**
	 * Checks if the provided integer is already in the specified or current default normalization form.
	 *
	 * @link http://www.php.net/manual/en/normalizer.isnormalized.php
	 * @param string $input The string to check.
	 * @param integer $normalization An optional normalization form to check against, overriding the default; see constructor.
	 * @return boolean TRUE if normalized, FALSE otherwise or if an error occurred.
	 * @throws \TYPO3\CMS\Core\Charset\Exception\NotImplementedException
	 */
	public function isNormalized($input, $normalization = NULL) {
		if ($this->useIntlNormalizer) {
			return \Normalizer::isNormalized($input, $normalization ?: $this->normalization);
		}
		return \Patchwork\PHP\Shim\Normalizer::isNormalized($input, $normalization ?: $this->normalization);
	}

	/**
	 * Normalizes the input provided and returns the normalized string.
	 *
	 * @link http://www.php.net/manual/en/normalizer.normalize.php
	 * @param string $input The string to normalize.
	 * @param integer $normalization An optional normalization form to check against, overriding the default; see constructor.
	 * @return string|NULL The normalized string or NULL if an error occurred.
	 * @throws \TYPO3\CMS\Core\Charset\Exception\NotImplementedException
	 */
	public function normalize($input, $normalization = NULL) {
		if ($this->useIntlNormalizer) {
			return \Normalizer::normalize($input, $normalization ?: $this->normalization);
		}
		return \Patchwork\PHP\Shim\Normalizer::normalize($input, $normalization ?: $this->normalization);
	}

	/**
	 * Set the current normalization form constant.
	 *
	 * @param integer $normalization
	 * @return void
	 */
	public function setNormalizationForm($normalization) {
		$availableNormalizations = $this->useIntlNormalizer
			? array(\Normalizer::NONE, \Normalizer::FORM_C, \Normalizer::FORM_D, \Normalizer::FORM_KC, \Normalizer::FORM_KD)
			: array(\Patchwork\PHP\Shim\Normalizer::NONE, \Patchwork\PHP\Shim\Normalizer::FORM_C, \Patchwork\PHP\Shim\Normalizer::FORM_D, \Patchwork\PHP\Shim\Normalizer::FORM_KC, \Patchwork\PHP\Shim\Normalizer::FORM_KD);
		if (!in_array($normalization, $availableNormalizations)) {
			throw new \InvalidArgumentException(sprintf('Invalid unicode-normalization form given: "%s".', $normalization), 1398603947);
		}
		$this->normalization = (integer) $normalization;
	}

	/**
	 * Retrieve the current normalization form constant.
	 *
	 * @return integer
	 */
	public function getNormalizationForm() {
		return $this->normalization;
	}
}
