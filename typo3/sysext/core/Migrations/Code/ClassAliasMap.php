<?php
return array(
	't3lib_cli' => 'TYPO3\\CMS\\Core\\Controller\\CommandLineController',
	'extDirect_DataProvider_ContextHelp' => 'TYPO3\\CMS\\ContextHelp\\ExtDirect\\ContextHelpDataProvider',
	't3lib_userAuth' => 'TYPO3\\CMS\\Core\\Authentication\\AbstractUserAuthentication',
	't3lib_beUserAuth' => 'TYPO3\\CMS\\Core\\Authentication\\BackendUserAuthentication',
	't3lib_autoloader' => 'TYPO3\\CMS\\Core\\Core\\ClassLoader',
	't3lib_cache_backend_AbstractBackend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\AbstractBackend',
	't3lib_cache_backend_ApcBackend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\ApcBackend',
	't3lib_cache_backend_Backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\BackendInterface',
	't3lib_cache_backend_FileBackend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\FileBackend',
	't3lib_cache_backend_MemcachedBackend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\MemcachedBackend',
	't3lib_cache_backend_NullBackend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\NullBackend',
	't3lib_cache_backend_PdoBackend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\PdoBackend',
	't3lib_cache_backend_PhpCapableBackend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\PhpCapableBackendInterface',
	't3lib_cache_backend_RedisBackend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\RedisBackend',
	't3lib_cache_backend_TransientMemoryBackend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\TransientMemoryBackend',
	't3lib_cache_backend_DbBackend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
	't3lib_cache' => 'TYPO3\\CMS\\Core\\Cache\\Cache',
	't3lib_cache_Factory' => 'TYPO3\\CMS\\Core\\Cache\\CacheFactory',
	't3lib_cache_Manager' => 'TYPO3\\CMS\\Core\\Cache\\CacheManager',
	't3lib_cache_Exception' => 'TYPO3\\CMS\\Core\\Cache\\Exception',
	't3lib_cache_exception_ClassAlreadyLoaded' => 'TYPO3\\CMS\\Core\\Cache\\Exception\\ClassAlreadyLoadedException',
	't3lib_cache_exception_DuplicateIdentifier' => 'TYPO3\\CMS\\Core\\Cache\\Exception\\DuplicateIdentifierException',
	't3lib_cache_exception_InvalidBackend' => 'TYPO3\\CMS\\Core\\Cache\\Exception\\InvalidBackendException',
	't3lib_cache_exception_InvalidCache' => 'TYPO3\\CMS\\Core\\Cache\\Exception\\InvalidCacheException',
	't3lib_cache_exception_InvalidData' => 'TYPO3\\CMS\\Core\\Cache\\Exception\\InvalidDataException',
	't3lib_cache_exception_NoSuchCache' => 'TYPO3\\CMS\\Core\\Cache\\Exception\\NoSuchCacheException',
	't3lib_cache_frontend_AbstractFrontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\AbstractFrontend',
	't3lib_cache_frontend_Frontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\FrontendInterface',
	't3lib_cache_frontend_PhpFrontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\PhpFrontend',
	't3lib_cache_frontend_StringFrontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\StringFrontend',
	't3lib_cache_frontend_VariableFrontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\VariableFrontend',
	't3lib_cs' => 'TYPO3\\CMS\\Core\\Charset\\CharsetConverter',
	't3lib_collection_AbstractRecordCollection' => 'TYPO3\\CMS\\Core\\Collection\\AbstractRecordCollection',
	't3lib_collection_Collection' => 'TYPO3\\CMS\\Core\\Collection\\CollectionInterface',
	't3lib_collection_Editable' => 'TYPO3\\CMS\\Core\\Collection\\EditableCollectionInterface',
	't3lib_collection_Nameable' => 'TYPO3\\CMS\\Core\\Collection\\NameableCollectionInterface',
	't3lib_collection_Persistable' => 'TYPO3\\CMS\\Core\\Collection\\PersistableCollectionInterface',
	't3lib_collection_RecordCollection' => 'TYPO3\\CMS\\Core\\Collection\\RecordCollectionInterface',
	't3lib_collection_RecordCollectionRepository' => 'TYPO3\\CMS\\Core\\Collection\\RecordCollectionRepository',
	't3lib_collection_Sortable' => 'TYPO3\\CMS\\Core\\Collection\\SortableCollectionInterface',
	't3lib_collection_StaticRecordCollection' => 'TYPO3\\CMS\\Core\\Collection\\StaticRecordCollection',
	't3lib_flexformtools' => 'TYPO3\\CMS\\Core\\Configuration\\FlexForm\\FlexFormTools',
	't3lib_matchCondition_abstract' => 'TYPO3\\CMS\\Core\\Configuration\\TypoScript\\ConditionMatching\\AbstractConditionMatcher',
	't3lib_DB' => 'TYPO3\\CMS\\Core\\Database\\DatabaseConnection',
	't3lib_PdoHelper' => 'TYPO3\\CMS\\Core\\Database\\PdoHelper',
	't3lib_DB_postProcessQueryHook' => 'TYPO3\\CMS\\Core\\Database\\PostProcessQueryHookInterface',
	't3lib_db_PreparedStatement' => 'TYPO3\\CMS\\Core\\Database\\PreparedStatement',
	't3lib_DB_preProcessQueryHook' => 'TYPO3\\CMS\\Core\\Database\\PreProcessQueryHookInterface',
	't3lib_queryGenerator' => 'TYPO3\\CMS\\Core\\Database\\QueryGenerator',
	't3lib_fullsearch' => 'TYPO3\\CMS\\Core\\Database\\QueryView',
	't3lib_refindex' => 'TYPO3\\CMS\\Core\\Database\\ReferenceIndex',
	't3lib_loadDBGroup' => 'TYPO3\\CMS\\Core\\Database\\RelationHandler',
	't3lib_softrefproc' => 'TYPO3\\CMS\\Core\\Database\\SoftReferenceIndex',
	't3lib_sqlparser' => 'TYPO3\\CMS\\Core\\Database\\SqlParser',
	't3lib_extTables_PostProcessingHook' => 'TYPO3\\CMS\\Core\\Database\\TableConfigurationPostProcessingHookInterface',
	't3lib_TCEmain' => 'TYPO3\\CMS\\Core\\DataHandling\\DataHandler',
	't3lib_TCEmain_checkModifyAccessListHook' => 'TYPO3\\CMS\\Core\\DataHandling\\DataHandlerCheckModifyAccessListHookInterface',
	't3lib_TCEmain_processUploadHook' => 'TYPO3\\CMS\\Core\\DataHandling\\DataHandlerProcessUploadHookInterface',
	't3lib_browseLinksHook' => 'TYPO3\\CMS\\Core\\ElementBrowser\\ElementBrowserHookInterface',
	't3lib_codec_JavaScriptEncoder' => 'TYPO3\\CMS\\Core\\Encoder\\JavaScriptEncoder',
	't3lib_error_AbstractExceptionHandler' => 'TYPO3\\CMS\\Core\\Error\\AbstractExceptionHandler',
	't3lib_error_DebugExceptionHandler' => 'TYPO3\\CMS\\Core\\Error\\DebugExceptionHandler',
	't3lib_error_ErrorHandler' => 'TYPO3\\CMS\\Core\\Error\\ErrorHandler',
	't3lib_error_ErrorHandlerInterface' => 'TYPO3\\CMS\\Core\\Error\\ErrorHandlerInterface',
	't3lib_error_Exception' => 'TYPO3\\CMS\\Core\\Error\\Exception',
	't3lib_error_ExceptionHandlerInterface' => 'TYPO3\\CMS\\Core\\Error\\ExceptionHandlerInterface',
	't3lib_error_http_AbstractClientErrorException' => 'TYPO3\\CMS\\Core\\Error\\Http\\AbstractClientErrorException',
	't3lib_error_http_AbstractServerErrorException' => 'TYPO3\\CMS\\Core\\Error\\Http\\AbstractServerErrorException',
	't3lib_error_http_BadRequestException' => 'TYPO3\\CMS\\Core\\Error\\Http\\BadRequestException',
	't3lib_error_http_ForbiddenException' => 'TYPO3\\CMS\\Core\\Error\\Http\\ForbiddenException',
	't3lib_error_http_PageNotFoundException' => 'TYPO3\\CMS\\Core\\Error\\Http\\PageNotFoundException',
	't3lib_error_http_ServiceUnavailableException' => 'TYPO3\\CMS\\Core\\Error\\Http\\ServiceUnavailableException',
	't3lib_error_http_StatusException' => 'TYPO3\\CMS\\Core\\Error\\Http\\StatusException',
	't3lib_error_http_UnauthorizedException' => 'TYPO3\\CMS\\Core\\Error\\Http\\UnauthorizedException',
	't3lib_error_ProductionExceptionHandler' => 'TYPO3\\CMS\\Core\\Error\\ProductionExceptionHandler',
	't3lib_exception' => 'TYPO3\\CMS\\Core\\Exception',
	't3lib_extMgm' => 'TYPO3\\CMS\\Core\\Utility\\ExtensionManagementUtility',
	't3lib_formprotection_Abstract' => 'TYPO3\\CMS\\Core\\FormProtection\\AbstractFormProtection',
	't3lib_formprotection_BackendFormProtection' => 'TYPO3\\CMS\\Core\\FormProtection\\BackendFormProtection',
	't3lib_formprotection_DisabledFormProtection' => 'TYPO3\\CMS\\Core\\FormProtection\\DisabledFormProtection',
	't3lib_formprotection_InvalidTokenException' => 'TYPO3\\CMS\\Core\\FormProtection\\Exception',
	't3lib_formprotection_Factory' => 'TYPO3\\CMS\\Core\\FormProtection\\FormProtectionFactory',
	't3lib_formprotection_InstallToolFormProtection' => 'TYPO3\\CMS\\Core\\FormProtection\\InstallToolFormProtection',
	't3lib_frontendedit' => 'TYPO3\\CMS\\Core\\FrontendEditing\\FrontendEditingController',
	't3lib_parsehtml' => 'TYPO3\\CMS\\Core\\Html\\HtmlParser',
	't3lib_parsehtml_proc' => 'TYPO3\\CMS\\Core\\Html\\RteHtmlParser',
	'TYPO3AJAX' => 'TYPO3\\CMS\\Core\\Http\\AjaxRequestHandler',
	't3lib_http_Request' => 'TYPO3\\CMS\\Core\\Http\\HttpRequest',
	't3lib_http_observer_Download' => 'TYPO3\\CMS\\Core\\Http\\Observer\\Download',
	't3lib_stdGraphic' => 'TYPO3\\CMS\\Core\\Imaging\\GraphicalFunctions',
	't3lib_admin' => 'TYPO3\\CMS\\Core\\Integrity\\DatabaseIntegrityCheck',
	't3lib_l10n_exception_FileNotFound' => 'TYPO3\\CMS\\Core\\Localization\\Exception\\FileNotFoundException',
	't3lib_l10n_exception_InvalidParser' => 'TYPO3\\CMS\\Core\\Localization\\Exception\\InvalidParserException',
	't3lib_l10n_exception_InvalidXmlFile' => 'TYPO3\\CMS\\Core\\Localization\\Exception\\InvalidXmlFileException',
	't3lib_l10n_Store' => 'TYPO3\\CMS\\Core\\Localization\\LanguageStore',
	't3lib_l10n_Locales' => 'TYPO3\\CMS\\Core\\Localization\\Locales',
	't3lib_l10n_Factory' => 'TYPO3\\CMS\\Core\\Localization\\LocalizationFactory',
	't3lib_l10n_parser_AbstractXml' => 'TYPO3\\CMS\\Core\\Localization\\Parser\\AbstractXmlParser',
	't3lib_l10n_parser' => 'TYPO3\\CMS\\Core\\Localization\\Parser\\LocalizationParserInterface',
	't3lib_l10n_parser_Llphp' => 'TYPO3\\CMS\\Core\\Localization\\Parser\\LocallangArrayParser',
	't3lib_l10n_parser_Llxml' => 'TYPO3\\CMS\\Core\\Localization\\Parser\\LocallangXmlParser',
	't3lib_l10n_parser_Xliff' => 'TYPO3\\CMS\\Core\\Localization\\Parser\\XliffParser',
	't3lib_lock' => 'TYPO3\\CMS\\Core\\Locking\\Locker',
	't3lib_mail_Mailer' => 'TYPO3\\CMS\\Core\\Mail\\Mailer',
	't3lib_mail_MailerAdapter' => 'TYPO3\\CMS\\Core\\Mail\\MailerAdapterInterface',
	't3lib_mail_Message' => 'TYPO3\\CMS\\Core\\Mail\\MailMessage',
	't3lib_mail_MboxTransport' => 'TYPO3\\CMS\\Core\\Mail\\MboxTransport',
	't3lib_mail_Rfc822AddressesParser' => 'TYPO3\\CMS\\Core\\Mail\\Rfc822AddressesParser',
	't3lib_message_AbstractMessage' => 'TYPO3\\CMS\\Core\\Messaging\\AbstractMessage',
	't3lib_message_AbstractStandaloneMessage' => 'TYPO3\\CMS\\Core\\Messaging\\AbstractStandaloneMessage',
	't3lib_message_ErrorpageMessage' => 'TYPO3\\CMS\\Core\\Messaging\\ErrorpageMessage',
	't3lib_FlashMessage' => 'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
	't3lib_FlashMessageQueue' => 'TYPO3\\CMS\\Core\\Messaging\\FlashMessageQueue',
	't3lib_PageRenderer' => 'TYPO3\\CMS\\Core\\Page\\PageRenderer',
	't3lib_Registry' => 'TYPO3\\CMS\\Core\\Registry',
	't3lib_Compressor' => 'TYPO3\\CMS\\Core\\Resource\\ResourceCompressor',
	't3lib_svbase' => 'TYPO3\\CMS\\Core\\Service\\AbstractService',
	't3lib_Singleton' => 'TYPO3\\CMS\\Core\\SingletonInterface',
	't3lib_TimeTrackNull' => 'TYPO3\\CMS\\Core\\TimeTracker\\NullTimeTracker',
	't3lib_timeTrack' => 'TYPO3\\CMS\\Core\\TimeTracker\\TimeTracker',
	't3lib_tree_Tca_AbstractTcaTreeDataProvider' => 'TYPO3\\CMS\\Core\\Tree\\TableConfiguration\\AbstractTableConfigurationTreeDataProvider',
	't3lib_tree_Tca_DatabaseTreeDataProvider' => 'TYPO3\\CMS\\Core\\Tree\\TableConfiguration\\DatabaseTreeDataProvider',
	't3lib_tree_Tca_DatabaseNode' => 'TYPO3\\CMS\\Core\\Tree\\TableConfiguration\\DatabaseTreeNode',
	't3lib_tree_Tca_ExtJsArrayRenderer' => 'TYPO3\\CMS\\Core\\Tree\\TableConfiguration\\ExtJsArrayTreeRenderer',
	't3lib_tree_Tca_TcaTree' => 'TYPO3\\CMS\\Core\\Tree\\TableConfiguration\\TableConfigurationTree',
	't3lib_tree_Tca_DataProviderFactory' => 'TYPO3\\CMS\\Core\\Tree\\TableConfiguration\\TreeDataProviderFactory',
	't3lib_tsStyleConfig' => 'TYPO3\\CMS\\Core\\TypoScript\\ConfigurationForm',
	't3lib_tsparser_ext' => 'TYPO3\\CMS\\Core\\TypoScript\\ExtendedTemplateService',
	't3lib_TSparser' => 'TYPO3\\CMS\\Core\\TypoScript\\Parser\\TypoScriptParser',
	't3lib_TStemplate' => 'TYPO3\\CMS\\Core\\TypoScript\\TemplateService',
	't3lib_utility_Array' => 'TYPO3\\CMS\\Core\\Utility\\ArrayUtility',
	't3lib_utility_Client' => 'TYPO3\\CMS\\Core\\Utility\\ClientUtility',
	't3lib_exec' => 'TYPO3\\CMS\\Core\\Utility\\CommandUtility',
	't3lib_utility_Command' => 'TYPO3\\CMS\\Core\\Utility\\CommandUtility',
	't3lib_utility_Debug' => 'TYPO3\\CMS\\Core\\Utility\\DebugUtility',
	't3lib_diff' => 'TYPO3\\CMS\\Core\\Utility\\DiffUtility',
	't3lib_basicFileFunctions' => 'TYPO3\\CMS\\Core\\Utility\\File\\BasicFileUtility',
	't3lib_extFileFunctions' => 'TYPO3\\CMS\\Core\\Utility\\File\\ExtendedFileUtility',
	't3lib_extFileFunctions_processDataHook' => 'TYPO3\\CMS\\Core\\Utility\\File\\ExtendedFileUtilityProcessDataHookInterface',
	't3lib_div' => 'TYPO3\\CMS\\Core\\Utility\\GeneralUtility',
	't3lib_utility_Http' => 'TYPO3\\CMS\\Core\\Utility\\HttpUtility',
	't3lib_utility_Mail' => 'TYPO3\\CMS\\Core\\Utility\\MailUtility',
	't3lib_utility_Math' => 'TYPO3\\CMS\\Core\\Utility\\MathUtility',
	't3lib_utility_Monitor' => 'TYPO3\\CMS\\Core\\Utility\\MonitorUtility',
	't3lib_utility_Path' => 'TYPO3\\CMS\\Core\\Utility\\PathUtility',
	't3lib_utility_PhpOptions' => 'TYPO3\\CMS\\Core\\Utility\\PhpOptionsUtility',
	't3lib_utility_VersionNumber' => 'TYPO3\\CMS\\Core\\Utility\\VersionNumberUtility',
);
