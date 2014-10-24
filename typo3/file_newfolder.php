<?php
/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Web>File: Create new folders in the filemounts
 *
 * @author Kasper Skårhøj <kasperYYYY@typo3.com>
 */
require __DIR__ . '/init.php';

\TYPO3\CMS\Core\Utility\GeneralUtility::deprecationLog(
	'Creating a new folder is moved to an own module. Please use BackendUtility::getModuleUrl(\'file_newfolder\') to link to this script. This script will be removed in two versions.'
);

$createFolderController = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Backend\\Controller\\File\\CreateFolderController');
$createFolderController->main();
$createFolderController->printContent();
