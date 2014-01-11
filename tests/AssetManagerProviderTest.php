<?php

use Wiseguydigital\Assetically\AssetManager\AssetManagerProvider;

class AssetManagerProviderTest extends AsseticallyTestCase {

	/**
	 * Asset manager
	 * @var \Wiseguydigital\Assets\AssetManagerProvider
	 */
	protected $asset_manager;

	/**
	 * On setup
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();
		$this->asset_manager = new AssetManagerProvider();
	}

	/**
	 * Test getEnvironment() exception
	 * @expectedException \RuntimeException
	 * @return void
	 */
	public function testEnvironmentException()
	{
		$this->asset_manager->getEnvironment();
	}

	/**
	 * Test getEnvironment()
	 * @return void
	 */
	public function testGetEnvironment()
	{
		$this->asset_manager->setEnvironment('testing');
		$this->assertNotNull($this->asset_manager->getEnvironment());
		$this->assertEquals($this->asset_manager->getEnvironment(), 'testing');
	}

	/**
	 * Test getSourceDirectory() exception
	 * @expectedException \RuntimeException
	 * @return void
	 */
	public function testGetSourceDirectoryException()
	{
		$this->asset_manager->getSourceDirectory();
	}

	/**
	 * Test setSourceDirectory()
	 * @return void
	 */
	public function testGetSourceDirectoryPath()
	{
		$this->asset_manager->setSourceDirectory('/path');
		$ap = $this->asset_manager->getSourceDirectory();
		$this->assertNotNull($ap);
		$this->assertInternalType('string', $ap);
		$this->assertEquals('/path', $ap);
	}

	/**
	 * Test getCdnDirectory() exception
	 * @expectedException \RuntimeException
	 * @return void
	 */
	public function testGetCdnDirectoryException() 
	{
		$this->asset_manager->getCdnDirectory();
	}

	/**
	 * Test getCdnDirectory()
	 * @return void
	 */
	public function testGetCdnDirectory()
	{
		$this->asset_manager->setCdnDirectory('/path');
		$cp = $this->asset_manager->getCdnDirectory();
		$this->assertNotNull($cp);
		$this->assertInternalType('string', $cp);
		$this->assertEquals('/path', $cp);
	}

	/**
	 * Test compiled stylesheet filename
	 * @return void
	 */
	public function testGetCompiledStylesheetFilename()
	{
		$filename = $this->asset_manager->getCompiledStylesheetFilename();
		$this->assertNotNull($filename);
		$this->assertInternalType('string', $filename);
		$this->assertEquals('compiled.css', $filename);

		$this->asset_manager->setCompiledStylesheetFilename('test.css');
		$new_filename = $this->asset_manager->getCompiledStylesheetFilename();
		$this->assertNotNull($new_filename);
		$this->assertInternalType('string', $new_filename);
		$this->assertEquals('test.css', $new_filename);
	}

	/**
	 * Test compiled javascript filename
	 * @return void
	 */
	public function testGetCompiledJavascriptFilename()
	{
		$filename = $this->asset_manager->getCompiledJavascriptFilename();
		$this->assertNotNull($filename);
		$this->assertInternalType('string', $filename);
		$this->assertEquals('compiled.js', $filename);

		$this->asset_manager->setCompiledJavascriptFilename('test.js');
		$new_filename = $this->asset_manager->getCompiledJavascriptFilename();
		$this->assertNotNull($new_filename);
		$this->assertInternalType('string', $new_filename);
		$this->assertEquals('test.js', $new_filename);
	}
	

}