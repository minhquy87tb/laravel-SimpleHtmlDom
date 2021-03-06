<?php

/**
 * Easy parssing markup languages.
 *
 * @package SimpleHtmlDom
 * @version 1.0
 * @author  Mahmoud Adel <amahmoudb@yahoo.com>
 * @link    https://github.com/EngMAF/laravel-SimpleHtmlDom
 */

require_once(__DIR__ . DS . 'libraries' . DS . 'simple_html_dom.php');

class SimpleHtmlDom {

	private $dom;
	private $array;
	private $error;

	/**
	 * take the file url and make a simpleHtmlDom object
	 *
	 * @param  string  $url
	 * @return object
	 */
	public static function url($url) 
	{
		$shd = new SimpleHtmlDom();
        $shd->dom = file_get_html($url);

        if(!$shd->dom)
			$shd->error = 'Failed to open stream: HTTP request failed!'; // Typical 404

        return $shd;
    }

	/**
	 * Get the array of node attribute value
	 *
	 * @param  string  $node
	 * @param  string  $attribute
	 * @return array
	 */
	public function get($nodes, $attribute = 'innertext')
	{
		$this->array = array();
        foreach ($this->dom->find($nodes) as $node) {
            $this->array[] = trim( $node->$attribute );
        }
        return $this;
	}

	/**
	 * Get the all elemrents of array of node attribute value
	 *
	 * @return array
	 */
	public function all()
	{
		if(empty($this->array))
			return null;
		
		return $this->array;
	}	

	/**
	 * Get the first elemrent of array of node attribute value
	 *
	 * @return string
	 */
	public function first()
	{
		if(empty($this->array))
			return null;
		
		reset($this->array);
		return current($this->array);
	}

	/**
	 * Get error that might have occurred while getting content of supplied
	 * URL
	 *
	 * @return string
	 */
	public function get_error()
	{
		return $this->error;
	}
}
