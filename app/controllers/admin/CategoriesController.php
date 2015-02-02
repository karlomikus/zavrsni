<?php namespace Admin;

use View;
use Category;
use Exception;
use Input;
use Redirect;

class CategoriesController extends BaseAdminController
{
    private $category;

    public function __construct(Category $category)
    {
        parent::__construct();
        $this->category = $category;
    }

    /**
     * Render view with categories list
     * 
     * @return View
     */
	public function index()
	{
        $categories = $this->category->paginate(15);
		return View::make('admin.categories.main')->with('categories', $categories);
	}

    /**
     * Render create form view
     * 
     * @return View
     */
    public function create()
    {
        return View::make('admin.categories.form')->with('category', $this->category);
    }

    /**
     * Save the category to database
     * 
     * @return Redirect Redirects back to list
     */
    public function store()
    {
        try
        {
            $error = null;
            $category = new Category();

            $category->name        = Input::get('name');
            $category->description = Input::get('description');

            $category->save();
        }
        catch(Exception $e)
        {
            $error = $e->getMessage();
        }

        return Redirect::to('admin/categories')->with('error', $error);
    }

    /**
     * Render category edit form
     * 
     * @param  int $id CategoryID
     * @return View
     */
    public function edit($id)
    {
        $category = $this->category->find($id);
        return View::make('admin.categories.form')->with('category', $category);
    }

    /**
     * Update category information in database
     * 
     * @param  int $id CategoryID
     * @return Redirect Redirects back to categories list
     */
    public function update($id)
    {
        try
        {
            $error = null;
            $category = $this->category->find($id);

            $category->name        = Input::get('name');
            $category->description = Input::get('description');

            $category->save();
        }
        catch(Exception $e)
        {
            $error = $e->getMessage();
        }

        return Redirect::to('admin/categories')->with('error', $error);
    }

    /**
     * Delets the category
     * 
     * @param  int $id CategoryID
     * @return Redirect     Redirects back to categories list
     */
    public function destroy($id)
    {
        try
        {
            $error = null;
            $cat = $this->category->find($id);
            $cat->delete();
        }
        catch (Exception $e)
        {
            $error = 'Category was not found.';
        }

        return Redirect::to('admin/categories')->with('error', $error);
    }
}