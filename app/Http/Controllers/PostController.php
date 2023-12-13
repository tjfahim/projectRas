<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function display()
    {
        $posts = Post::where('status', 'active')->orderBy('created_at', 'desc')->paginate(20);

        return view('welcome', ['posts' => $posts]);
    }


    public function index()
    {
        $user = Auth::user();

        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(12);

        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.process');
    }

    /**
     * Store a newly created resource in storage.
     */

     public function process(Request $request, $id = null)
        {
            if ($id) {
                $posts = Post::find($id);
                if ($posts->user_id !== auth()->id()) {
                    return redirect()->route('post.index')->with('error', 'Unauthorized action.');
                }
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',
                ]);
                if ($request->hasFile('image')) {
                    $validator->addRules([
                        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    ]);
                }
               
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                
                $input = $request->all();
                if ($image = $request->file('image')) {
                    $destinationPath = 'image/';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;
                    
                    if ($posts->image) {
                        unlink(public_path($destinationPath . $posts->image));
                    }
                }
            
                $input['status'] = $request->status;
                $input['user_id'] = auth()->user()->id;

                $posts->update($input);
                return redirect()->route('post.index')->with('success', 'Post Updated successfully.');
               
            } else {
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',                 
                    'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    
                ]);
        
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                $input = $request->all();
           
                if ($image = $request->file('image')) {
                    $destinationPath = 'image/';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;
                }
                $input['status'] = 'active';
                $input['user_id'] = auth()->user()->id;

                Post::create($input);
                return redirect()->route('post.index')->with('success', 'Post Added successfully.');
            }
        }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('post.index')->with('error', 'Unauthorized action.');
        }
        if (!$post) {
            return redirect()->route('post.index')->with('error', 'post not found.');
        }
        return view('post.process', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('post.index')->with('error', 'Unauthorized action.');
        }
        $post->delete();
        return redirect()->route('post.index')->with('success', 'Post deleted successfully.');

    }
}
