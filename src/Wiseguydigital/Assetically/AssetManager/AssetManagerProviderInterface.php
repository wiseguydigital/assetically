<?php

namespace Wiseguydigital\Assetically\AssetManager;

interface AssetManagerProviderInterface {
	
	public function getEnvironment();

	public function setEnvironment($environment);

	public function getCompiledStylesheetFilename();

	public function getCompiledJavascriptFilename();

	public function getSourceDirectory();

	public function setSourceDirectory($src_dir);

	public function getLocalDirectory();

	public function setLocalDirectory($local_dir);

	public function getCdnDirectory();

	public function setCdnDirectory($cdn_dir);

	public function prepareAssets();

}