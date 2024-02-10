<?php

namespace App\Http\Controllers\backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.sub_category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.sub_category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required', 'string', 'max:200'],
            'category_id'=> ['required', 'exists:categories,id'],
        ],
        [],
        [
            'category_id'=>'category'
        ]);
        SubCategory::create($request->except('_token'));

        toastr()->success('Sub Category Created Successfully!');
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        return view('admin.sub_category.edit', compact('sub_category','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $sub_category = SubCategory::findOrFail($id);
        $request->validate([
            'name'=>['required', 'string', 'max:200'],
            'category_id'=> ['required', 'exists:categories,id'],
        ],
        [],
        [
            'category_id'=>'category'
        ]);

        $sub_category->update($request->except('_token', '_method'));

        toastr()->success('Sub Category Updated Successfully!');
        return redirect()->route('admin.sub_category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $subCategory = SubCategory::findOrFail($id);

        if ($subCategory->products != null and $subCategory->products->count() != 0) {
            return response(['status' => 'error', 'message' => 'You can\'t delete a subcategory that has products.']);
        }
        if ($subCategory->child_categories->count() > 0) {
            return response(['status' => 'error', 'message' => 'You can\'t delete a sub category that has child categories.']);
        }

        $subCategory->delete();

        return response(['status' => 'success', 'message' => 'Sub Category Deleted Successfully!']);
    }


    /**
     * Change status.
     */

    public function switch_status(Request $request)
    {
        $sub_category = SubCategory::findOrFail($request->id);
        $sub_category->update(['status'=>$request->checked]);
        return response(['status'=>'success', 'message'=>'Status Changed Successfully!']);
    }
}
