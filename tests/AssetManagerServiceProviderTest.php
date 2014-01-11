<?php

class AssetManagerServiceProviderTest extends AsseticallyTestCase {

	/**
	 * Test register asset manager
	 * @return void
	 */
	public function testRegisterAssetManager() 
	{
		$this->assertNotEmpty($this->app['assetically'], 'Assetically does not exist in the application');
		$this->assertInstanceOf('\Wiseguydigital\Assetically\AssetManager\AssetManagerProviderInterface', $this->app['assetically']);
	}

}