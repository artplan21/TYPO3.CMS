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
 * Class for normalizing unicode. Depending on what has been configured in the install-tool, this implementation is a
 * simple facade, either to “php-intl” extension's “Normalizer”-class or to the homonymous fallback shim-class from the
 * faboulus “Patchwork-UTF8” project.
 *
 * @author Stephan Jorek <stephan.jorek@artplan21.de>
 * @see http://forge.typo3.org/issues/57695
 * @see http://www.php.net/manual/en/class.normalizer.php
 * @see http://en.wikipedia.org/wiki/Unicode_equivalence
 * @see http://stackoverflow.com/questions/7931204/what-is-normalized-utf-8-all-about
 * @see http://www.w3.org/TR/charmod-norm/
 * @see http://blog.whatwg.org/tag/unicode
 */
class UnicodeNormalizer {

	const

	/**
	 * No decomposition/composition
	 */
	NONE = 1,

	/**
	 * Normalization Form D (NFD) - Canonical Decomposition
	 */
	FORM_D  = 2, NFD  = 2,

	/**
	 * Normalization Form KD (NFKD) - Compatibility Decomposition
	 */
	FORM_KD = 3, NFKD = 3,

	/**
	 * Normalization Form C (NFC) - Canonical Decomposition followed by Canonical Composition
	 */
	FORM_C  = 4, NFC  = 4,

	/**
	 * Normalization Form KC (NFKC) - Compatibility Decomposition followed by Canonical Composition
	 */
	FORM_KC = 5, NFKC = 5;

	/**
	 * Indicates which unicode normalization form to use. Must be set to one of the constants from above. Defaults to NONE.
	 *
	 * @var integer
	 */
	protected $normalization = self::NONE;

	/**
	 * A flag indicating which normalizer to use - TRUE means use Normalizer from PHP's “intl”-extension,
	 * anything else will fall back to pure PHP-code from the Patchwork project.
	 *
	 * @var boolean
	 */
	protected $useIntlExtension = NULL;

	/**
	 * Constructor
	 *
	 * @link http://www.php.net/manual/en/class.normalizer.php
	 * @param integer $normalization Optionally set normalization form to one of the known constants; NONE is default.
	 * @param string $implementation Optionally set normalization implementation. Available are: “intl” and “patchwork”.
	 */
	public function __construct($normalization = NULL, $implementation = NULL) {
		$this->useIntlExtension = 'intl' === ($implementation ?: $GLOBALS['TYPO3_CONF_VARS']['SYS']['unicodeNormalizer']);
		$this->setNormalizationForm($normalization ?: $GLOBALS['TYPO3_CONF_VARS']['SYS']['unicodeNormalization']);
	}

	/**
	 * Checks if the provided $input is already in the specified or current default normalization form.
	 *
	 * @link http://www.php.net/manual/en/normalizer.isnormalized.php
	 * @param string $input The string to check.
	 * @param integer $normalization An optional normalization form to check against, overriding the default; see constructor.
	 * @return boolean TRUE if normalized, FALSE otherwise or if an error occurred.
	 */
	public function isNormalized($input, $normalization = NULL) {
		if ($this->useIntlExtension) {
			return \Normalizer::isNormalized($input, (int) ($normalization ?: $this->normalization));
		}
		return \Patchwork\PHP\Shim\Normalizer::isNormalized($input, (int) ($normalization ?: $this->normalization));
	}

	/**
	 * Normalizes the $input provided to the given $normalization or the default one, and returns the normalized string.
	 *
	 * @link http://www.php.net/manual/en/normalizer.normalize.php
	 * @param string $input The string to normalize.
	 * @param integer $normalization An optional normalization form to check against, overriding the default; see constructor.
	 * @return string|NULL The normalized string or NULL if an error occurred.
	 */
	public function normalize($input, $normalization = NULL) {
		if ($this->useIntlExtension) {
			return \Normalizer::normalize($input, (int) ($normalization ?: $this->normalization));
		}
		return \Patchwork\PHP\Shim\Normalizer::normalize($input, (int) ($normalization ?: $this->normalization));
	}

	/**
	 * Set the current normalization-form constant to the given $normalization. Also see constructor.
	 *
	 * @param integer $normalization
	 * @return void
	 * @throws \InvalidArgumentException
	 */
	public function setNormalizationForm($normalization) {
		if (!in_array($normalization, range(1, 5))) {
			throw new \InvalidArgumentException(sprintf('Invalid unicode-normalization form given: %s.', $normalization), 1398603947);
		}
		$this->normalization = $normalization;
	}

	/**
	 * Retrieve the current normalization-form constant.
	 *
	 * @return integer
	 */
	public function getNormalizationForm() {
		return $this->normalization;
	}
}
