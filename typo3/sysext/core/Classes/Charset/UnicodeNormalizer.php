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
	 * Constructor
	 *
	 * @link http://www.php.net/manual/en/class.normalizer.php
	 * @param integer $normalization Optionally set normalization form to one of the known constants; NONE is default.
	 */
	public function __construct($normalization = NULL) {
		$this->registerImplementationIfNeeded($GLOBALS['TYPO3_CONF_VARS']['SYS']['unicodeNormalizer']);
		$this->setNormalizationForm($normalization === NULL ? $GLOBALS['TYPO3_CONF_VARS']['SYS']['unicodeNormalization'] : $normalization);
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
		$normalization = (int) ($normalization === NULL ? $this->normalization : $normalization);
		// Hint: UnicodeNormalizerImpl is a class_alias defined in self::registerImplementationIfNeeded
		return UnicodeNormalizerImpl::isNormalized($input, $normalization);
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
		$normalization = (int) ($normalization === NULL ? $this->normalization : $normalization);
		// Hint: UnicodeNormalizerImpl is a class_alias defined in self::registerImplementationIfNeeded
		return UnicodeNormalizerImpl::normalize($input, $normalization);
	}

	/**
	 * Normalize all elements in ARRAY with type string to given unicode-normalization-form.
	 * NOTICE: Array is passed by reference!
	 *
	 * @param array $array Input array, possibly multidimensional
	 * @param integer $normalization An optional normalization form to check against, overriding the default; see constructor.
	 * @return void
	 * @see normalize()
	 */
	public function normalizeArray(array & $array, $normalization = NULL) {
		$this->processArrayWithMethod('normalize', $array, $normalization);
	}

	/**
	 * Ensures that given input is (well formed and) normalized UTF-8.
	 *
	 * This implementation has been taken from the contributed “Patchwork-UTF8” project's
	 * “Bootup::filterString()”-method and tweaked for our needs.
	 *
	 * @param string $input
	 * @param integer $normalization An optional normalization form to check against, overriding the default; see constructor.
	 * @param string $leading_combining
	 * @return string
	 * @see \Patchwork\Utf8\Bootup::filterString()
	 * @todo keep method in sync with \Patchwork\Utf8\Bootup::filterString()
	 */
	public function filter($input, $normalization = NULL, $leading_combining = '◌') {
		if (false !== strpos($input, "\r")) {
			// Workaround https://bugs.php.net/65732
			$input = str_replace("\r\n", "\n", $input);
			$input = strtr($input, "\r", "\n");
		}

		if (preg_match('/[\x80-\xFF]/', $input)) {
			if ($this->isNormalized($input, $normalization)) {
				$normalized = '-';
			} else {
				$normalized = $this->normalize($input, $normalization);
				if (isset($normalized[0])) {
					$input = $normalized;
				} else {
					// TODO Patchwork-UTF8 implementation handles cp1252 as a fallback too, but we don't do so. Is it right ?
					$input = utf8_encode($input);
				}
			}

			if ($input[0] >= "\x80" && isset($normalized[0], $leading_combining[0]) && preg_match('/^\p{Mn}/u', $input)) {
				// Prevent leading combining chars
				// for NFC-safe concatenations.
				$input = $leading_combining . $input;
			}
		}

		return $input;
	}

	/**
	 * Ensures for all elements in ARRAY with type string to be well formed and normalized UTF-8.
	 * NOTICE: Array is passed by reference!
	 *
	 * @param array $array Input array, possibly multidimensional
	 * @param integer $normalization An optional normalization form to check against, overriding the default; see constructor.
	 * @return void
	 * @see filter()
	 */
	public function filterArray(array & $array, $normalization = NULL) {
		$this->processArrayWithMethod('filter', $array, $normalization);
	}

	/**
	 * Ensures all that all (user-)inputs ($_FILES, $_ENV, $_GET, $_POST, $_COOKIE, $_SERVER, $_REQUEST)
	 * are (well formed and) normalized UTF-8 if needed.
	 *
	 * This implementation has been inspired by the contributed “Patchwork-UTF8” project's
	 * “Bootup::filterRequestInputs()”-method and tweaked for our needs.
	 *
	 * @param integer $normalization An optional normalization form to check against, overriding the default; see constructor.
	 * @return void
	 * @see \Patchwork\Utf8\Bootup::filterRequestInputs()
	 * @todo Use this method during bootstrap ? If yes, then avoid double-encoding by TSFE->convPOSTCharset !
	 */
	public function filterAllInputArrays($normalization = NULL) {
		foreach (array(&$_FILES, &$_ENV, &$_GET, &$_POST, &$_COOKIE, &$_SERVER, &$_REQUEST) as $array) {
			if (!is_array($array) || empty($array)) {
				continue ;
			}
			$this->filterArray($array, $normalization);
		}
	}

	/**
	 * Set the current normalization-form constant to the given $normalization. Also see constructor.
	 *
	 * @param integer $normalization
	 * @return void
	 * @throws \InvalidArgumentException
	 */
	public function setNormalizationForm($normalization) {
		if (!in_array((int) $normalization, range(1, 5), TRUE)) {
			throw new \InvalidArgumentException(sprintf('Unknown unicode-normalization form: %s.', $normalization), 1398603947);
		}
		$this->normalization = (int) $normalization;
	}

	/**
	 * Retrieve the current normalization-form constant.
	 *
	 * @return integer
	 */
	public function getNormalizationForm() {
		return $this->normalization;
	}

	/**
	 * Process all elements in ARRAY with type string with a method of this object.
	 * NOTICE: Array is passed by reference!
	 *
	 * @param string $method the method used to process the value of all strings
	 * @param array $array Input array, possibly multidimensional
	 * @param integer $normalization An optional normalization form to check against, overriding the default; see constructor.
	 * @return void
	 */
	protected function processArrayWithMethod($method, array & $array, $normalization = NULL) {
		foreach ($array as $key => $value) {
			if (empty($value)) {
				continue;
			} elseif (is_array($value)) {
				$this->processArrayWithMethod($method, $array[$key], $normalization);
			} elseif (is_string($value) && !$this->isNormalized($value, $normalization)) {
				$array[$key] = call_user_method($method, $this, $value, $normalization);
			}
		}
	}

	/**
	 * Registers a class-alias for the globally configured normalizer implementation. This happens only once !
	 *
	 * @return boolean TRUE on success
	 */
	protected function registerImplementationIfNeeded($implementation) {
		$implementationAlias = get_class($this) . 'Impl';
		if (class_exists($implementationAlias, FALSE)) {
			return TRUE;
		}
		$autoload = TRUE;
		switch ($implementation) {
			case 'intl':
				$implementationClass = 'Normalizer';
				$autoload = FALSE;
				break;
			case 'patchwork':
				$implementationClass = 'Patchwork\\PHP\\Shim\\Normalizer';
				break;
			// case 'stub':
			case '':
				$implementationClass = 'TYPO3\\CMS\\Core\\Charset\\UnicodeNormalizerStub';
				break;
			default:
				throw new \InvalidArgumentException(sprintf('Unknown implementation given: %s.', $implementation), 1399749988);
		}
		return class_alias($implementationClass, $implementationAlias, $autoload);
	}
}
