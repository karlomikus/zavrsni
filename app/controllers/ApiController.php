<?php

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;

class ApiController extends Controller {
	
    protected $fractal;
    protected $statusCode = 200;
    protected $info = null;

    function __construct(Manager $fractal)
    {
    	$this->fractal = $fractal;
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
	 * Generate error message response
	 * 
	 * @param  string $error Error message
	 * @return Response
	 */
	protected function respondWithError($error)
	{
		$response = [
			'data' => null,
			'error' => $error
		];

		return $this->setStatusCode(400)->respondWithArray($response);
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
	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
		return $this;
	}
}
