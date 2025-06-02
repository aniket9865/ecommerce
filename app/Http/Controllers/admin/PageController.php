<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    // Display a listing of the pages
    public function index(Request $request)
    {
        $search = $request->input('search');
        $pages = Page::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('admin.page.list', compact('pages'));
    }

    // Show the form for creating a new page
    public function create()
    {
        return view('admin.page.create');
    }

    // Store a newly created page in storage
    public function store(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'slug' => 'required|unique:pages,slug',
            'content' => 'nullable',
        ]);

        if ($validator->passes()) {
            // Create a new page entry
            $page = new Page();
            $page->name = $request->input('name');
            $page->slug = $request->input('slug');
            $page->content = $request->input('content');
            $page->save();

            return response()->json([
                'status' => true,
                'message' => 'Page has been created successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    // Show the form for editing the specified page
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.page.edit', compact('page'));
    }

    // Update the specified page in storage
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'slug' => 'required|unique:pages,slug,' . $page->id,
            'content' => 'nullable',
        ]);

        if ($validator->passes()) {
            // Update the page entry
            $page->name = $request->input('name');
            $page->slug = $request->input('slug');
            $page->content = $request->input('content');
            $page->save();

            return response()->json([
                'status' => true,
                'message' => 'Page has been updated successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    // Remove the specified page from storage
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return response()->json([
            'status' => true,
            'message' => 'Page has been deleted successfully',
        ]);
    }
}
