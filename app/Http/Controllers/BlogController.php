<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Traits\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    use FileHelper;

    function create(Request $request) {
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'image' => ['required', 'image', 'max:2048'],
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $this->saveFileAndGetName(request()->File('image'), Blog::class);
            $data['image'] = $image;
        }
        $data['user_id'] = Auth::id();
        $blog = Blog::create($data);
        if ($blog) {
            return response()->json([
                'message' => 'Blog Created successfully'
            ], 200);
        }
        else {
            return response()->json([
                'message' => 'Something went wrong'
            ], 404);
        }
    }

    function update(Request $request, $id) {
        if (!is_null($id)) {
            $request->validate([
                'title' => ['required', 'string', 'max:100'],
                'description' => ['required', 'string'],
                'image' => ['nullable', 'image', 'max:2048'],
            ]);
            $data = $request->all();
            $blog = Blog::findOrFail($id);
            if ($request->hasFile('image')) {
                $image = $this->updateFileAndGetName(request()->file('image'), Blog::class);
            }
            else
                $image = $blog->image;
            $data['image'] = $image;
            if (!is_null($blog)) {

                $blog->update($data);

                return response()->json([
                    'message' => 'Blog Updated successfully'
                ], 200);
            }
            else {
                return response()->json([
                    'message' => 'Blog not found'
                ], 404);
            }
        }

        return response()->json([
            'message' => "Invalid ID"
        ], 404);
    }

    function show(){
        $blogs = Blog::with(['user', 'comment'])->paginate(1);
        return response()->json([
            'data' => $blogs
        ], 200);
    }

    function delete($id) {
        $blog = Blog::find($id);

        if ($blog) {
            $this->deleteFile($blog->image);
            $blog->delete();
            return response()->json([
                'message', 'Blog Has Been Deleted Successfully'
            ], 200);
        }
        else {
            return response()->json([
                'message' => 'Blog not found'
            ], 404);
        }
    }

    function commentsPost(Request $request, $id) {
        $blog = Blog::findOrFail($id);
        if (!is_null($blog)) {
            $request->validate([
                'name' => ['required', 'string', 'max:100'],
                'review' => ['required','string']
            ]);
            $data = $request->all();
            $data['blog_id'] = $blog->id;
            $comment = Comment::create($data);
            if ($comment) {
                return response()->json([
                    'data' => $comment,
                    'message' => 'Comment Posted Successfully'
                ], 200);
            }
            else {
                return response()->json([
                    'message' => 'Something went wrong'
                ], 404);
            }
        }
    }
}
