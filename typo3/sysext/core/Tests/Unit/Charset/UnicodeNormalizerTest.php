<?php
namespace TYPO3\CMS\Core\Tests\Unit\Charset;

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

use \TYPO3\CMS\Core\Charset\UnicodeNormalizer;

/**
 * Testcase for \TYPO3\CMS\Core\Charset\UnicodeNormalizer
 *
 * @author Stephan Jorek <stephan.jorek@artplan21.de>
 */
class UnicodeNormalizerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \TYPO3\CMS\Core\Charset\UnicodeNormalizer
	 */
	protected $fixture = NULL;

	public function setUp() {
		$this->fixture = new UnicodeNormalizer();
	}

	///////////////////////////////////
	// Tests concerning isNormalized
	///////////////////////////////////

	/**
	 * DataProvider for test: checkIfStringIsNormalized
	 *
	 * Provides the following types of strings:
	 *
	 * - pure ASCII strings
	 * - UTF8 encoded strings, normalized to …
	 *   - … NFC: pre-composed unicode-strings
	 *   - … NFD: decomposed unicode-strings
	 * - combination of all string-types from above
	 *
	 * @return array<array<boolean|string|integer>>
	 */
	public function checkIfStringIsNormalizedDataProvider() {
		$ascii_dejavu = 'dejavu';
		// fantasy-string: déjàvü
		$nfc_dejavu = hex2bin('64c3a96ac3a076c3bc');
		// the same string as above, but decomposed
		$nfd_dejavu = hex2bin('6465cc816a61cc807675cc88');
		// combination of all three strings from above
		$ascii_nfc_nfd_dejavu = $ascii_dejavu.$nfc_dejavu.$nfd_dejavu;

		return array(
			// pure ASCII string
			'ASCII - is not normalized if form is NONE' => array(
				FALSE, $ascii_dejavu, UnicodeNormalizer::NONE
			),
			'ASCII - is in normalization-form D' => array(
				TRUE, $ascii_dejavu, UnicodeNormalizer::NFD
			),
			'ASCII - is in normalization-form DK' => array(
				TRUE, $ascii_dejavu, UnicodeNormalizer::NFKD
			),
			'ASCII - is in normalization-form C' => array(
				TRUE, $ascii_dejavu, UnicodeNormalizer::NFC
			),
			'ASCII - is in normalization-form KC' => array(
				TRUE, $ascii_dejavu, UnicodeNormalizer::NFKC
			),
			// unicode string in normalization-form C
			'NFC - is not normalized if form is NONE' => array(
				FALSE, $nfc_dejavu, UnicodeNormalizer::NONE
			),
			'NFC - is not in normalization-form D' => array(
				FALSE, $nfc_dejavu, UnicodeNormalizer::NFD
			),
			'NFC - is not in normalization-form DK' => array(
				FALSE, $nfc_dejavu, UnicodeNormalizer::NFKD
			),
			'NFC - is in normalization-form C' => array(
				TRUE, $nfc_dejavu, UnicodeNormalizer::NFC
			),
			'NFC - may be in normalization-form KC' => array(
				TRUE, $nfc_dejavu, UnicodeNormalizer::NFKC
			),
			// unicode string in normalization-form D
			'NFD - is not normalized if form is NONE' => array(
				FALSE, $nfd_dejavu, UnicodeNormalizer::NONE
			),
			'NFD - is in normalization-form D' => array(
				TRUE, $nfd_dejavu, UnicodeNormalizer::NFD
			),
			'NFD - may be in normalization-form DK' => array(
				TRUE, $nfd_dejavu, UnicodeNormalizer::NFKD
			),
			'NFD - is not in normalization-form C' => array(
				FALSE, $nfd_dejavu, UnicodeNormalizer::NFC
			),
			'NFD - is not in normalization-form KC' => array(
				FALSE, $nfd_dejavu, UnicodeNormalizer::NFKC
			),
			// combination of ascii and unicode strings in normalization-forms C and D
			'ASCII + NFC + NFD - is not normalized if form is NONE' => array(
				FALSE, $ascii_nfc_nfd_dejavu, UnicodeNormalizer::NONE
			),
			'ASCII + NFC + NFD - is not in normalization-form D' => array(
				FALSE, $ascii_nfc_nfd_dejavu, UnicodeNormalizer::NFD
			),
			'ASCII + NFC + NFD - is not in normalization-form DK' => array(
				FALSE, $ascii_nfc_nfd_dejavu, UnicodeNormalizer::NFKD
			),
			'ASCII + NFC + NFD - is not in normalization-form D' => array(
				FALSE, $ascii_nfc_nfd_dejavu, UnicodeNormalizer::NFC
			),
			'ASCII + NFC + NFD - is not in normalization-form KC' => array(
				FALSE, $ascii_nfc_nfd_dejavu, UnicodeNormalizer::NFKC
			),
		);
	}

	/**
	 * Check if unicode-normalization-detection works for the provided types of strings
	 *
	 * @test
	 * @dataProvider checkIfStringIsNormalizedDataProvider
	 * @see http://forge.typo3.org/issues/57695
	 *
	 * @param boolean $expectedResult
	 * @param string $testString
	 * @param integer $normalizationForm
	 * @return void
	 */
	public function checkIfStringIsNormalized($expectedResult, $testString, $normalizationForm) {
		$actualResult = $this->fixture->isNormalized($testString, $normalizationForm);
		if ($expectedResult === TRUE) {
			$this->assertTrue($actualResult);
		} elseif ($expectedResult === FALSE) {
			$this->assertFalse($actualResult);
		} else {
			$this->assertSame($expectedResult, $actualResult);
		}
	}

	///////////////////////////////////
	// Tests concerning normalize
	///////////////////////////////////

	/**
	 * DataProvider for test: checkStringNormalization
	 *
	 * Provides the following types of strings:
	 *
	 * - pure ASCII strings
	 * - UTF8 encoded strings,not …
	 *   - … NFC: pre-composed unicode-strings
	 *   - … NFD: decomposed unicode-strings
	 * - combination of all string-types from above
	 *
	 * @return array<array<boolean|string|integer>>
	 */
	public function checkStringNormalizationDataProvider() {
		$ascii_dejavu = 'dejavu';
		// fantasy-string: déjàvü
		$nfc_dejavu = hex2bin('64c3a96ac3a076c3bc');
		// the same string as above, but decomposed
		$nfd_dejavu = hex2bin('6465cc816a61cc807675cc88');
		// combination of all three strings from above
		$ascii_nfc_nfd_dejavu = $ascii_dejavu.$nfc_dejavu.$nfd_dejavu;
		// the same as above, but already normalized to form D
		$nfd_dejavu_triple = hex2bin('64656a6176756465cc816a61cc807675cc886465cc816a61cc807675cc88');
		// the same as from two above, but already normalized to form C
		$nfc_dejavu_triple = hex2bin('64656a61767564c3a96ac3a076c3bc64c3a96ac3a076c3bc');

		return array(
			// pure ASCII string
			'ASCII - normalized is identical if form is NONE' => array(
				TRUE, $ascii_dejavu, UnicodeNormalizer::NONE
			),
			'ASCII - normalized to form D is identical' => array(
				TRUE, $ascii_dejavu, UnicodeNormalizer::FORM_D
			),
			'ASCII - normalized to form DK is identical' => array(
				TRUE, $ascii_dejavu, UnicodeNormalizer::FORM_KD
			),
			'ASCII - normalized to form C is identical' => array(
				TRUE, $ascii_dejavu, UnicodeNormalizer::FORM_C
			),
			'ASCII - normalized to form KC is identical' => array(
				TRUE, $ascii_dejavu, UnicodeNormalizer::FORM_KC
			),
			// unicode string in normalization-form C
			'NFC - normalized is identical if form is NONE' => array(
				TRUE, $nfc_dejavu, UnicodeNormalizer::NONE
			),
			'NFC - normalized to form D is different' => array(
				FALSE, $nfc_dejavu, UnicodeNormalizer::FORM_D
			),
			'NFC - normalized to form DK is different' => array(
				FALSE, $nfc_dejavu, UnicodeNormalizer::FORM_KD
			),
			'NFC - normalized to form C is identical' => array(
				TRUE, $nfc_dejavu, UnicodeNormalizer::FORM_C
			),
			'NFC - normalized to form KC may be identical' => array(
				TRUE, $nfc_dejavu, UnicodeNormalizer::FORM_KC
			),
			// unicode string in normalization-form D
			'NFD - normalized is identical if form is NONE' => array(
				TRUE, $nfd_dejavu, UnicodeNormalizer::NONE
			),
			'NFD - normalized to form D is identical' => array(
				TRUE, $nfd_dejavu, UnicodeNormalizer::FORM_D
			),
			'NFD - normalized to form DK may be identical' => array(
				TRUE, $nfd_dejavu, UnicodeNormalizer::FORM_KD
			),
			'NFD - normalized to form C is different' => array(
				FALSE, $nfd_dejavu, UnicodeNormalizer::FORM_C
			),
			'NFD - normalized to form KC is different' => array(
				FALSE, $nfd_dejavu, UnicodeNormalizer::FORM_KC
			),
			// combination of ascii and unicode strings in normalization-forms C and D
			'ASCII + NFC + NFD - normalized is identical if form is NONE' => array(
				$ascii_nfc_nfd_dejavu, $ascii_nfc_nfd_dejavu, UnicodeNormalizer::NONE
			),
			'ASCII + NFC + NFD - normalized to form D' => array(
				$nfd_dejavu_triple, $ascii_nfc_nfd_dejavu, UnicodeNormalizer::NFD
			),
			'ASCII + NFC + NFD - normalized to form DK' => array(
				$nfd_dejavu_triple, $ascii_nfc_nfd_dejavu, UnicodeNormalizer::NFKD
			),
			'ASCII + NFC + NFD - normalized to form C' => array(
				$nfc_dejavu_triple, $ascii_nfc_nfd_dejavu, UnicodeNormalizer::NFC
			),
			'ASCII + NFC + NFD - normalized to form KC' => array(
				$nfc_dejavu_triple, $ascii_nfc_nfd_dejavu, UnicodeNormalizer::NFKC
			),
		);

	}

	/**
	 * Check if unicode-normalization works for the provided types of strings
	 *
	 * @test
	 * @dataProvider checkStringNormalizationDataProvider
	 * @see http://forge.typo3.org/issues/57695
	 *
	 * @param boolean $expectedResult
	 * @param string $testString
	 * @param integer $normalizationForm
	 * @return void
	 */
	public function checkStringNormalization($expectedResult, $testString, $normalizationForm) {
		$actualResult = $this->fixture->normalize($testString, $normalizationForm);
		if ($expectedResult === TRUE) {
			$this->assertSame($testString, $actualResult);
		} elseif ($expectedResult === FALSE) {
			$this->assertNotSame($testString, $actualResult);
		} else {
			$this->assertSame($expectedResult, $actualResult);
		}
	}
}
