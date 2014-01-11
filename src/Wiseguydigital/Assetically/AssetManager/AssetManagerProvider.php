<?php

namespace Wiseguydigital\Assetically\AssetManager;

class AssetManagerProvider
{
	/**
	 * Compiled CSS filename
	 * @var string
	 */
	protected $compiled_css_filename;

	/**
	 * Compiled JS filename
	 * @var string
	 */
	protected $compiled_js_filename;
	
	/**
	 * Environment
	 * @var string
	 */
	protected $environment;

	/**
	 * Source directory
	 * @var string
	 */
	protected $source_dir;

	/**
	 * Local dir
	 * @var string
	 */
	protected $local_dir;

	/**
	 * CDN dir
	 * @var string
	 */
	protected $cdn_dir;

	/**
	 * Get environment
	 * @return string
	 */
	public function getEnvironment()
	{
		if ($this->environment === null) {
			throw new \RuntimeException('An environment has not been declared');
		}
		return $this->environment;
	}

	/**
	 * Set environment
	 * @param string $environment Environment
	 */
	public function setEnvironment($environment)
	{
		$this->environment = $environment;
	}

	/**
	 * Get source directory
	 * @return string Source path
	 */
	public function getSourceDirectory()
	{
		if ($this->source_dir === null) {
			throw new \RuntimeException('A source directory path has not been declared');
		}
		return $this->source_dir;
	}

	/**
	 * Set source directory path
	 * @param string $source_dir Source path
	 */
	public function setSourceDirectory($source_dir)
	{
		$this->source_dir = $source_dir;
	}

	/**
	 * Get local directory
	 * @return string local Local path
	 */
	public function getLocalDirectory()
	{
		if ($this->local_dir === null) {
			throw new \RuntimeException('A local directory has not been declared');
		}
		return $this->local_dir;
	}

	/**
	 * Set local directory path
	 * @param string $local_dir Local path
	 */
	public function setLocalDirectory($local_dir)
	{
		$this->local_dir = $local_dir;
	}

	/**
	 * Get CDN directory
	 * @return string CDN path
	 */
	public function getCdnDirectory()
	{
		if ($this->cdn_dir === null) {
			throw new \RuntimeException('A CDN directory has not been declared');
		}
		return $this->cdn_dir;
	}

	/**
	 * Set CDN directory path
	 * @param string $cdn_dir CDN path
	 */
	public function setCdnDirectory($cdn_dir)
	{
		$this->cdn_dir = $cdn_dir;
	}

	/**
	 * Get compiled stylesheet public path
	 * @return string
	 */
	public function getCompiledStylesheetFilename()
	{
		if ($this->compiled_css_filename === null) {
			$this->compiled_css_filename = 'compiled.css';
		}
		return $this->compiled_css_filename;
	}

	/**
	 * Set compiled stylesheet filename
	 * @param string $filename
	 */
	public function setCompiledStylesheetFilename($filename)
	{
		$this->compiled_css_filename = trim($filename);
	}

	/**
	 * Get compiled javascipt filename
	 * @return string
	 */
	public function getCompiledJavascriptFilename()
	{
		if ($this->compiled_js_filename === null) {
			$this->compiled_js_filename = 'compiled.js';
		}
		return $this->compiled_js_filename;
	}

	/**
	 * Set compiled javascript filename
	 * @param string $filename
	 */
	public function setCompiledJavascriptFilename($filename)
	{
		$this->compiled_js_filename = trim($filename);
	}

	/**
	 * Stylesheets
	 * @return string Final path for stylesheets
	 */
	public function stylesheets()
	{
		return $this->getWebDirectory() . '/' . $this->getCompiledStylesheetFilename();
	}

	/**
	 * Javascripts
	 * @return string Final path for javascripts
	 */
	public function javascripts()
	{
		return $this->getWebDirectory() . '/' . $this->getCompiledStylesheetFilename();
	}

	/**
	 * Get web directory
	 * @return [type] [description]
	 */
	public function getWebDirectory()
	{
		return str_replace(public_path(), '', $this->getLocalDirectory());
	}

}