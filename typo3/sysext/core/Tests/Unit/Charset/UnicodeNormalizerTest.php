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
		$this->fixture = new \TYPO3\CMS\Core\Charset\UnicodeNormalizer();
	}

	///////////////////////////////////
	// Tests concerning isNormalized
	///////////////////////////////////
	/**
	 * @test
	 * @see http://forge.typo3.org/issues/57695
	 */
	public function stringIsNormalized() {
		$this->fail('missing unit-test implementation');
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
