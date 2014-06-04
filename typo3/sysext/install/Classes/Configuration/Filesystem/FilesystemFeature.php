<?php
namespace TYPO3\CMS\Install\Configuration\Filesystem;

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
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Install\Configuration;

/**
 * Filesystem - Non-UTF8 as well as UTF8 with and without unicode normalization feature
 *
 * - Custom    utf8- or non-utf8-filesystem without unicode-normalization (“old” behaviour)
 * - NonUTF8   non-utf8 filesystem without unicode-normalization (“old” behaviour ?)
 * - UTF8      utf8 filesystem without unicode-normalization (“old” behaviour ?)
 * - UTF8Nfc   utf8 filesystem with unicode-normalization from and to NFC for paths and typo3 internals plus vice versa where needed (“new” behaviour)
 * - UTF8Nfkc  utf8 filesystem with unicode-normalization from NFKC for paths to NFC for typo3 internals plus vice versa where needed (“new” behaviour)
 * - UTF8Nfd   utf8 filesystem with unicode-normalization from NFD for paths to NFC for typo3 internals plus vice versa where needed (“new” behaviour)
 * - UTF8Nfkd  utf8 filesystem with unicode-normalization from NFKD for paths to NFC for typo3 internals plus vice versa where needed (“new” behaviour)
 *
 * @author Stephan Jorek <stephan.jorek@artplan21.de>
 */
class FilesystemFeature extends Configuration\AbstractFeature implements Configuration\FeatureInterface {

	/**
	 * @var string Name of feature
	 */
	protected $name = 'Filesystem';

	/**
	 * @var array List of preset classes
	 */
	protected $presetRegistry = array(
		'TYPO3\\CMS\\Install\\Configuration\\Filesystem\\CustomFilesystemPreset',
		'TYPO3\\CMS\\Install\\Configuration\\Filesystem\\NonUTF8FilesystemPreset',
		'TYPO3\\CMS\\Install\\Configuration\\Filesystem\\UTF8FilesystemPreset',
		'TYPO3\\CMS\\Install\\Configuration\\Filesystem\\UTF8NfcFilesystemPreset',
		'TYPO3\\CMS\\Install\\Configuration\\Filesystem\\UTF8NfkcFilesystemPreset',
		'TYPO3\\CMS\\Install\\Configuration\\Filesystem\\UTF8NfdFilesystemPreset',
		'TYPO3\\CMS\\Install\\Configuration\\Filesystem\\UTF8NfkdFilesystemPreset',
	);
}
