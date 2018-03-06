#!/usr/bin/env php
<?php

	require_once(dirname(__DIR__) . '/boot/start.php');


	(new Tool\Sitemap\Gen)
		->setActionType('save_xml')
		->setSourceDirPath(THE_SITEMAP_SOURCE_DIR_PATH)
		->setBaseUri(THE_SITEMAP_BASE_URI)
		->setSaveFilePath(THE_SITEMAP_SAVE_XML_FILE_PATH)
		->run()
	;
