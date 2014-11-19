<?php

class CategoriesController extends \BaseController
{
    /**
     * Display a listing of the category.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(Category::get());
    }

    /**
     * Store a newly created category in storage.
     *
     * @return Response
     */
    public function store()
    {
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Response::json(Project::find($id));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
    }
}
