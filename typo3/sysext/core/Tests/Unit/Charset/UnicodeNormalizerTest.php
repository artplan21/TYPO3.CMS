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
	 * Check if normalization-detection works for pure ascii strings
	 *
	 * @test
	 * @see http://forge.typo3.org/issues/57695
	 */
	public function checkAsciiStringIsNormalized() {

		$ascii_dejavu = 'dejavu';

		$this->assertFalse($this->fixture->isNormalized($dejavu, UnicodeNormalizer::NONE));
		$this->assertTrue($this->fixture->isNormalized($dejavu, UnicodeNormalizer::FORM_D));
		$this->assertTrue($this->fixture->isNormalized($dejavu, UnicodeNormalizer::FORM_KD));
		$this->assertTrue($this->fixture->isNormalized($dejavu, UnicodeNormalizer::FORM_C));
		$this->assertTrue($this->fixture->isNormalized($dejavu, UnicodeNormalizer::FORM_KC));
	}

	/**
	 * Check if normalization-detection works for pre-composed unicode-strings (only utf8)
	 *
	 * @test
	 * @see http://forge.typo3.org/issues/57695
	 */
	public function checkPrecomposedStringIsNormalized() {
		// fantasy-string: déjàvü
		$nfc_dejavu = hex2bin('64c3a96ac3a076c3bc');

		$this->assertFalse($this->fixture->isNormalized($nfc_dejavu, UnicodeNormalizer::NONE));
		$this->assertFalse($this->fixture->isNormalized($nfc_dejavu, UnicodeNormalizer::FORM_D));
		$this->assertFalse($this->fixture->isNormalized($nfc_dejavu, UnicodeNormalizer::FORM_KD));
		$this->assertTrue($this->fixture->isNormalized($nfc_dejavu, UnicodeNormalizer::FORM_C));
		$this->assertTrue($this->fixture->isNormalized($nfc_dejavu, UnicodeNormalizer::FORM_KC));
	}

	/**
	 * Check if normalization-detection works for decomposed unicode-strings (only utf8)
	 *
	 * @test
	 * @see http://forge.typo3.org/issues/57695
	 */
	public function checkDecomposedStringIsNormalized() {
		// the same string as above, but decomposed
		$nfd_dejavu = hex2bin('6465cc816a61cc807675cc88');

		$this->assertFalse($this->fixture->isNormalized($nfd_dejavu, UnicodeNormalizer::NONE));
		$this->assertTrue($this->fixture->isNormalized($nfd_dejavu, UnicodeNormalizer::FORM_D));
		$this->assertTrue($this->fixture->isNormalized($nfd_dejavu, UnicodeNormalizer::FORM_KD));
		$this->assertFalse($this->fixture->isNormalized($nfd_dejavu, UnicodeNormalizer::FORM_C));
		$this->assertFalse($this->fixture->isNormalized($nfd_dejavu, UnicodeNormalizer::FORM_KC));
	}

	/**
	 * Check if normalization-detection works for combined pre- and decomposed unicode-strings (only utf8)
	 *
	 * @test
	 * @see http://forge.typo3.org/issues/57695
	 */
	public function checkCombinedStringIsNormalized() {
		// combination of all three strings from above
		$ascii_nfc_nfd_dejavu = 'dejavu'.hex2bin('64c3a96ac3a076c3bc').hex2bin('6465cc816a61cc807675cc88');

		$this->assertFalse($this->fixture->isNormalized($ascii_nfc_nfd_dejavu, UnicodeNormalizer::NONE));
		$this->assertFalse($this->fixture->isNormalized($ascii_nfc_nfd_dejavu, UnicodeNormalizer::FORM_D));
		$this->assertFalse($this->fixture->isNormalized($ascii_nfc_nfd_dejavu, UnicodeNormalizer::FORM_KD));
		$this->assertFalse($this->fixture->isNormalized($ascii_nfc_nfd_dejavu, UnicodeNormalizer::FORM_C));
		$this->assertFalse($this->fixture->isNormalized($ascii_nfc_nfd_dejavu, UnicodeNormalizer::FORM_KC));
	}

	///////////////////////////////////
	// Tests concerning normalize
	///////////////////////////////////

	/**
	 * @test
	 * @see http://forge.typo3.org/issues/57695
	 */
	public function stringNormalization() {
		$this->fail('missing unit-test implementation');
	}

}
