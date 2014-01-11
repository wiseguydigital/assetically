<?php

namespace Wiseguydigital\Assetically\AssetManager;

use Wiseguydigital\Assetically\AssetManager\AssetManagerProvider;
use Assetic\AssetManager;
use Assetic\AssetWriter;
use Assetic\Asset\FileAsset;
use Assetic\Asset\GlobAsset;
use Assetic\Asset\AssetCollection;
use Assetic\Filter\FilterCollection;
use Assetic\Filter\LessphpFilter;
use Assetic\Filter\CssMinFilter;

class AsseticAssetManagerProvider extends AssetManagerProvider implements AssetManagerProviderInterface {

	/**
	 * Asset Manager
	 * @var \Assetic\AssetManager
	 */
	protected $asset_manager;

	/**
	 * Filters for all environments
	 * @var array
	 */
	protected $environment_filters;

	/**
	 * Constructor
	 * @param string $environment    	Environment
	 * @param string $source_dir    	Source directpry - where the original assets are stored
	 * @param string $local_dir 		Directory for local output
	 * @param string $cdn_dir   		Directory for CDN output
	 */
	public function __construct($environment = null, $source_dir = null, $local_dir = null, $cdn_dir = null)
	{
		$this->setEnvironment($environment);
		$this->setSourceDirectory($source_dir);
		$this->setLocalDirectory($local_dir);
		$this->setCdnDirectory($cdn_dir);
		$this->asset_manager = new AssetManager();
		$this->environment_filters = array();

		$this->createStylesheetCollection();
		$this->createJavascriptCollection();

	}

	/**
	 * Get instance should actually return an instance of AAM
	 * @return \Assetic\AssetManager Assetic asset manager
	 */
	public function getAsseticAssetManager()
	{
		return $this->asset_manager;
	}

	/**
	 * Create stylesheet collection
	 * @return void
	 */
	public function createStylesheetCollection()
	{
		$css = new AssetCollection();
		$css->setTargetPath($this->getCompiledStylesheetFilename());
		$this->asset_manager->set('css', $css);
	}

	/**
	 * Create javascript collection
	 * @return void
	 */
	public function createJavascriptCollection()
	{
		$js = new AssetCollection();
		$js->setTargetPath($this->getCompiledJavascriptFilename());
		$this->asset_manager->set('js', $js);
	}

	/**
	 * Get stylesheet collection
	 * @return \Assetic\Asset\AssetCollection
	 */
	public function getStylesheetCollection()
	{
		return $this->asset_manager->get('css');
	}

	/**
	 * Add less file to 'css'
	 * @param string $filename
	 */
	public function addLessFile($filename)
	{
		$file_path = $this->getSourceDirectory() . DIRECTORY_SEPARATOR . 'less' . DIRECTORY_SEPARATOR . $filename;
		$this->getStylesheetCollection()->add(new FileAsset($file_path));
	}

	/**
	 * Get javascript collection
	 * @return \Assetic\Asset\AssetCollection
	 */
	public function getJavascriptCollection()
	{
		return $this->asset_manager->get('js');
	}

	/**
	 * Prepare assets
	 * @param  string $environment Environment
	 * @param  string $public_path Public path
	 * @return mixed              
	 */
	public function prepareAssets()
	{
		if ($this->getEnvironment() === 'local') {
			$this->prepareLocalAssets();
		}
	}

	/**
	 * Prepare local assets
	 * @return void
	 */
	public function prepareLocalAssets()
	{
		$writer = new AssetWriter($this->getLocalDirectory());
		$writer->writeManagerAssets($this->asset_manager);
	}

	/**
	 * Prepare CDN assets
	 * @return [type] [description]
	 */
	public function prepareCdnAssets()
	{
		$writer = new AssetWriter($this->getCdnDirectory());
		$writer->writeManagerAssets($this->asset_manager);
	}

}