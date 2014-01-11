<?php namespace Wiseguydigital\Assetically;

use Illuminate\Support\ServiceProvider;

use Wiseguydigital\Assetically\AssetManager\AsseticAssetManagerProvider;
use Assetic\Filter\FilterCollection;
use Assetic\Filter\LessphpFilter;
use Assetic\Filter\CssMinFilter;

class AsseticallyServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;


	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('wiseguydigital/assetically');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerAssetManager();
        $this->registerOutputHandler();
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

	/**
     * Register asset manager
     * @return void
     */
    public function registerAssetManager()
    {
        $this->app->singleton('assetically', function($app) {
        	$asset_manager = new AsseticAssetManagerProvider($app->environment());
            return $asset_manager;
        });
    }

    /**
     * Register output handler
     * @return void
     */
    public function registerOutputHandler()
    {
    	$app = $this->app;

    	if ($this->app->environment() === 'production') return false;
    	
    	$this->app->before(function($request) use ($app) {

    		$asset_manager = $app['assetically'];

    		$src_path = $app['config']->get('assetically::src_path');
    		$local_path = $app['config']->get('assetically::local_path');
    		$cdn_path = $app['config']->get('assetically::cdn_path');

    		$asset_manager->setSourceDirectory($src_path);
    		$asset_manager->setLocalDirectory($local_path);
    		$asset_manager->setCdnDirectory($cdn_path);

    	});

    	$this->app->after(function($request) use ($app) {
    		$asset_manager = $app['assetically'];
    		$this->addLocalFilters();
    		$asset_manager->prepareAssets();
    	});
    }

    /**
     * Create local filter collection
     * @return void
     */
    public function addLocalFilters()
    {
    	$asset_manager = $this->app['assetically'];
    	$asset_manager->getAsseticAssetManager()->get('css')->ensureFilter(new LessphpFilter());
    }

}