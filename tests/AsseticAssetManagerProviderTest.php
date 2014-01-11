<?php

use Wiseguydigital\Assetically\AssetManager\AsseticAssetManagerProvider;
use Assetic\Filter\FilterCollection;

class AsseticAssetManagerProviderTest extends Orchestra\Testbench\TestCase {

	/**
	 * Asset manager
	 * @var \Wiseguydigital\Assets\AsseticAssetManagerProvider
	 */
	protected $asset_manager;

	/**
	 * Test assets path
	 * @var string
	 */
	protected $test_assets_dir;

	/**
	 * Setup
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();
		$this->asset_manager = new AsseticAssetManagerProvider($this->app->environment(), 'path');
		$this->test_assets_dir = realpath(__DIR__) . '/test-files';
	}

	/**
	 * Teardown
	 * @return void
	 */
	public function teardown()
	{
		parent::teardown();
		if (is_dir($this->test_assets_dir)) {

			$compiled_css = $this->test_assets_dir . DIRECTORY_SEPARATOR . $this->asset_manager->getCompiledStylesheetFilename();
			$compiled_js = $this->test_assets_dir . DIRECTORY_SEPARATOR . $this->asset_manager->getCompiledJavascriptFilename();

			if (file_exists($compiled_css)) {
				unlink($compiled_css);
			}
			if (file_exists($compiled_js)) {
				unlink($compiled_js);
			}
			rmdir($this->test_assets_dir);
		}
	}

	/**
	 * Test getAsseticAssetManager
	 * @return void 
	 */
	public function testGetAsseticAssetManager()
	{
		$am = $this->asset_manager->getAsseticAssetManager();
		$this->assertInstanceof('\Assetic\AssetManager', $am);
	}

	/**
	 * Test createStylesheetCollection()		
	 * @return void
	 */
	public function testCreateStylesheetCollection()
	{
		$this->asset_manager->createStylesheetCollection();
		$css = $this->asset_manager->getAsseticAssetManager()->get('css');
		$css->add(new \Assetic\Asset\GlobAsset('test'));

		$this->assertNotNull($css);
		$this->assertInstanceof('\Assetic\Asset\AssetCollection', $css);

		$assets = $css->all();
		foreach ($assets as $i => $asset) {
			$this->assertInstanceof('\Assetic\Asset\AssetInterface', $asset);
		}
	}

	/**
	 * Test getStylesheetCollection()
	 * @return void
	 */
	public function testGetStylesheetCollection()
	{
		$collection = $this->asset_manager->getStylesheetCollection();
		$this->assertInstanceof('\Assetic\Asset\AssetCollection', $collection);
	}

	/**
	 * Test createJavascriptCollection()		
	 * @return void
	 */
	public function testCreateJavascriptCollection()
	{
		$this->asset_manager->createJavascriptCollection();
		$js = $this->asset_manager->getAsseticAssetManager()->get('js');
		$js->add(new \Assetic\Asset\GlobAsset('test'));

		$this->assertNotNull($js);
		$this->assertInstanceof('\Assetic\Asset\AssetCollection', $js);

		$assets = $js->all();
		foreach ($assets as $i => $asset) {
			$this->assertInstanceof('\Assetic\Asset\AssetInterface', $asset);
		}
	}

	/**
	 * Test getJavascriptCollection()
	 * @return void
	 */
	public function testGetJavascriptCollection()
	{
		$collection = $this->asset_manager->getJavascriptCollection();
		$this->assertInstanceof('\Assetic\Asset\AssetCollection', $collection);
	}

	/**
	 * Test prepareLocalAssets()
	 * @return void
	 */
	public function testPrepareLocalAssets()
	{
		$collection = new \Assetic\Asset\AssetCollection();

		$combined_css = $this->test_assets_dir . DIRECTORY_SEPARATOR . $this->asset_manager->getCompiledStylesheetFilename();
		$combined_js = $this->test_assets_dir . DIRECTORY_SEPARATOR . $this->asset_manager->getCompiledJavascriptFilename();

		$this->asset_manager->setLocalDirectory($this->test_assets_dir);
		$this->asset_manager->prepareLocalAssets();
		$this->assertFileExists($combined_css);
		$this->assertFileExists($combined_js);

		$this->assertEquals('', file_get_contents($combined_css));
		$this->assertEquals('', file_get_contents($combined_js));

	}

}