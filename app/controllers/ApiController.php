<?php

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;

class ApiController extends BaseController
{
    protected $fractal;
    protected $statusCode = 200;

    /**
     * Inject fractal manager
     * 
     * @param Manager $fractal
     */
    function __construct(Manager $fractal)
    {
    	parent::__construct();
    	$this->fractal = $fractal;
    }

    /**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if (!is_null($this->layout))
			$this->layout = View::make($this->layout);
	}

	/**
	 * Single resource item response
	 * 
	 * @param  mixed $item
	 * @param  mixed $callback
	 * @return Response
	 */
	protected function respondWithItem($item, $callback)
	{
		$resource = new Item($item, $callback);

		$data = $this->fractal->createData($resource);

		return $this->respondWithArray($data->toArray());
	}

	/**
	 * Multiple item collection response
	 * 
	 * @param  mixed $collection
	 * @param  mixed $callback
	 * @return Response
	 */
	protected function respondWithCollection($collection, $callback)
	{
		$resource = new Collection($collection, $callback);

		$data = $this->fractal->createData($resource);

		return $this->respondWithArray($data->toArray());
	}

	/**
	 * Generate JSON response
	 * 
	 * @param  array  $array   Data
	 * @param  array  $headers Optional headers
	 * @return Response        Response with status code and optional headers
	 */
	protected function respondWithArray(array $array, array $headers = [])
	{
		return Response::json($array, $this->statusCode, $headers);
	}

	/* Getters and setters */

	public function getStatusCode()
	{
		return $this->statusCode;
	}

	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
		return $this;
	}
}
