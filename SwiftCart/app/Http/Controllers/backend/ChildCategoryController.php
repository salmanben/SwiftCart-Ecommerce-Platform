<?php

namespace App\Http\Controllers\backend;
use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Exception;
use Illuminate\Support\Str;
class ChildCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.child_category.index');
    }


     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.child_category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required', 'string', 'max:200'],
            'category'=> ['required', 'exists:categories,id'],
            'sub_category'=> ['required', 'exists:sub_categories,id'],
        ]);
        ChildCategory::create([
            'name'=>$request->name,
            'status'=>$request->status,
            'category_id'=>$request->category,
            'sub_category_id'=>$request->sub_category
        ]);

        toastr()->success('Child Category Created Successfully!');
        return redirect()->back();
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $child_category = ChildCategory::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        $sub_categories = Category::find($child_category->category_id)->sub_categories;

        return view('admin.child_category.edit', compact('child_category','categories', 'sub_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $child_category = ChildCategory::findOrFail($id);

        $request->validate([
            'name'=>['required', 'string', 'max:200'],
            'category'=> ['required', 'exists:categories,id'],
            'sub_category'=> ['required', 'exists:sub_categories,id'],
        ]);

        $child_category->update([
            'name'=>$request->name,
            'status'=>$request->status,
            'category_id'=>$request->category,
            'sub_category_id'=>$request->sub_category,
        ]);

        toastr()->success('Child Category Updated Successfully!');
        return redirect()->route('admin.child_category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $child_category = ChildCategory::findOrFail($id);
        if ($child_category->products != null and $child_category->products->count() != 0){
            return response(['status' => 'error', 'message' => 'You can\'t delete a child  category that has products.']);
        }

        $child_category->delete();

        return response(['status' => 'success', 'message' => 'Child Category Deleted Successfully!']);
    }


    /**
     * Change status.
     */

    public function switch_status(Request $request)
    {
        $child_category = ChildCategory::findOrFail($request->id);
        $child_category->update(['status'=>$request->checked]);
        return response(['status'=>'success', 'message'=>'Status Changed Successfully!']);
    }

    /**
     * Get sub categories of a specific category
     */

    public function get_sub_categories(Request $request)
    {
        $sub_categories = Category::find($request->id)->sub_categories()->where('status', 1)->get();
        return response($sub_categories);
    }
}
