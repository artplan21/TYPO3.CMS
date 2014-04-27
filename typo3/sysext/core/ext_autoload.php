<?php
// Adapt this file if things need to be available in the bootstrap
$flowClassesPath = __DIR__ . '/Resources/PHP/TYPO3.Flow/Classes/';
return array(
	'ext_posmap_pages' => PATH_typo3 . 'move_el.php',
	'ext_posmap_tt_content' => PATH_typo3 . 'move_el.php',
	'moveelementlocalpagetree' => PATH_typo3 . 'move_el.php',
	'newrecordlocalpagetree' => PATH_typo3 . 'db_new.php',
	'localfoldertree' => PATH_typo3 . 'class.browse_links.php',
	'tbe_foldertree' => PATH_typo3 . 'class.browse_links.php',
	'tbe_pagetree' => PATH_typo3 . 'class.browse_links.php',
	'localpagetree' => PATH_typo3 . 'class.browse_links.php',
	'transferdata' => PATH_typo3 . 'show_item.php',
	'Psr\\Log\\LoggerInterface' => PATH_typo3 . 'contrib/Psr/Log/LoggerInterface.php',
	'Psr\\Log\\InvalidArgumentException' => PATH_typo3 . 'contrib/Psr/Log/InvalidArgumentException.php',
	'Patchwork\\PHP\\Shim\\Normalizer' => PATH_typo3 . 'contrib/Patchwork-UTF8/patchwork/utf8/class/Patchwork/PHP/Shim/Normalizer.php',
	'typo3\flow\package\documentation\format' => $flowClassesPath . 'TYPO3/Flow/Package/Documentation/Format.php',
	'typo3\flow\package\documentation' => $flowClassesPath . 'TYPO3/Flow/Package/Documentation.php',
	'typo3\flow\package\exception\corruptpackageexception' => $flowClassesPath . 'TYPO3/Flow/Package/Exception/CorruptPackageException.php',
	'typo3\flow\package\exception\duplicatepackageexception' => $flowClassesPath . 'TYPO3/Flow/Package/Exception/DuplicatePackageException.php',
	'typo3\flow\package\exception\invalidpackagekeyexception' => $flowClassesPath . 'TYPO3/Flow/Package/Exception/InvalidPackageKeyException.php',
	'typo3\flow\package\exception\invalidpackagemanifestexception' => $flowClassesPath . 'TYPO3/Flow/Package/Exception/InvalidPackageManifestException.php',
	'typo3\flow\package\exception\invalidpackagepathexception' => $flowClassesPath . 'TYPO3/Flow/Package/Exception/InvalidPackagePathException.php',
	'typo3\flow\package\exception\invalidpackagestateexception' => $flowClassesPath . 'TYPO3/Flow/Package/Exception/InvalidPackageStateException.php',
	'typo3\flow\package\exception\missingpackagemanifestexception' => $flowClassesPath . 'TYPO3/Flow/Package/Exception/MissingPackageManifestException.php',
	'typo3\flow\package\exception\packagekeyalreadyexistsexception' => $flowClassesPath . 'TYPO3/Flow/Package/Exception/PackageKeyAlreadyExistsException.php',
	'typo3\flow\package\exception\packagerepositoryexception' => $flowClassesPath . 'TYPO3/Flow/Package/Exception/PackageRepositoryException.php',
	'typo3\flow\package\exception\packagestatesfilenotwritableexception' => $flowClassesPath . 'TYPO3/Flow/Package/Exception/PackageStatesFileNotWritableException.php',
	'typo3\flow\package\exception\protectedpackagekeyexception' => $flowClassesPath . 'TYPO3/Flow/Package/Exception/ProtectedPackageKeyException.php',
	'typo3\flow\package\exception\unknownpackageexception' => $flowClassesPath . 'TYPO3/Flow/Package/Exception/UnknownPackageException.php',
	'typo3\flow\package\exception' => $flowClassesPath . 'TYPO3/Flow/Package/Exception.php',
	'typo3\flow\package\metadata\abstractconstraint' => $flowClassesPath . 'TYPO3/Flow/Package/MetaData/AbstractConstraint.php',
	'typo3\flow\package\metadata\abstractparty' => $flowClassesPath . 'TYPO3/Flow/Package/MetaData/AbstractParty.php',
	'typo3\flow\package\metadata\company' => $flowClassesPath . 'TYPO3/Flow/Package/MetaData/Company.php',
	'typo3\flow\package\metadata\packageconstraint' => $flowClassesPath . 'TYPO3/Flow/Package/MetaData/PackageConstraint.php',
	'typo3\flow\package\metadata\person' => $flowClassesPath . 'TYPO3/Flow/Package/MetaData/Person.php',
	'typo3\flow\package\metadata\systemconstraint' => $flowClassesPath . 'TYPO3/Flow/Package/MetaData/SystemConstraint.php',
	'typo3\flow\package\metadata' => $flowClassesPath . 'TYPO3/Flow/Package/MetaData.php',
	'typo3\flow\package\metadatainterface' => $flowClassesPath . 'TYPO3/Flow/Package/MetaDataInterface.php',
	'typo3\flow\package\package' => $flowClassesPath . 'TYPO3/Flow/Package/Package.php',
	'typo3\flow\package\packagefactory' => $flowClassesPath . 'TYPO3/Flow/Package/PackageFactory.php',
	'typo3\flow\package\packageinterface' => $flowClassesPath . 'TYPO3/Flow/Package/PackageInterface.php',
	'typo3\flow\package\packagemanager' => $flowClassesPath . 'TYPO3/Flow/Package/PackageManager.php',
	'typo3\flow\package\packagemanagerinterface' => $flowClassesPath . 'TYPO3/Flow/Package/PackageManagerInterface.php',
	'typo3\flow\utility\files' => $flowClassesPath . 'TYPO3/Flow/Utility/Files.php',
	'typo3\flow\utility\exception' => $flowClassesPath . 'TYPO3/Flow/Utility/Exception.php',
	'typo3\flow\exception' => $flowClassesPath . 'TYPO3/Flow/Exception.php',
);
