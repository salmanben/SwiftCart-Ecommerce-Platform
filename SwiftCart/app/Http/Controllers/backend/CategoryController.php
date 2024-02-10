<?php

namespace App\Http\Controllers\backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeSetting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name'],
            'icon' => ['required', 'not_in:empty'],
        ]);
        Category::create($request->except('_token'));

        toastr()->success('Category Created Successfully!');
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $category = Category::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name,' . $id],
            'icon' => ['required', 'not_in:empty'],
        ]);

        $category->update($request->except('_token', '_method'));

        toastr()->success('Category Updated Successfully!');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        if ($category->products != null and $category->products->count() != 0) {
            return response(['status' => 'error', 'message' => 'You can\'t delete a category that has products.']);
        }

        if ($category->sub_categories->count() > 0) {
            return response(['status' => 'error', 'message' => 'You can\'t delete a category that has sub categories.']);
        }
        $top_categories = HomeSetting::where('key', 'top_categories')->first();
        if ($top_categories) {
            $top_categories = $top_categories->value;
            $top_categories = json_decode($top_categories);
            if (in_array($id, $top_categories)) {
                return response(['status' => 'error', 'message' => 'You can\'t delete a category that is top category']);
            }
        }

        $single_categories = HomeSetting::where('key', 'single_categories')->first();
        if ($single_categories) {
            $single_categories = $single_categories->value;
            $single_categories = json_decode($single_categories);
            if (in_array($id, $single_categories)) {
                return response(['status' => 'error', 'message' => 'You can\'t delete a category that is included in single categories']);
            }
        }

        $category->delete();

        return response(['status' => 'success', 'message' => 'Category Deleted Successfully!']);
    }


    /**
     * Change status.
     */

    public function switch_status(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $top_categories = HomeSetting::where('key', 'top_categories')->first();
        if ($top_categories) {
            $top_categories = $top_categories->value;
            $top_categories = json_decode($top_categories);
            if (in_array($request->id, $top_categories)) {
                return response(['status' => 'error', 'message' => 'You can\'t change status of a category that is included in top categories']);
            }
        }
        $single_categories = HomeSetting::where('key', 'single_categories')->first();
        if ($single_categories) {
            $single_categories = $single_categories->value;
            $single_categories = json_decode($single_categories);
            if (in_array($request->id, $single_categories)) {
                return response(['status' => 'error', 'message' => 'You can\'t change status of a category that  is included in single categories']);
            }
        }
        $category->update(['status' => $request->checked]);
        return response(['status' => 'success', 'message' => 'Status Changed Successfully!']);
    }
}
