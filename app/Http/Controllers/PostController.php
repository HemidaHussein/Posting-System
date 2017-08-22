<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{


    function getAll()
    {
        return Post::paginate(5);
    }

    function create(Request $request)
    {
        $rules = array(
            'body' => 'required|max:255',
            'image1' => 'required|max:10240|mimes:jpeg,jpg,png',
            'image2' => 'required|max:10240|mimes:jpeg,jpg,png',
            'image3' => 'required|max:10240|mimes:jpeg,jpg,png',


        );
        $validator = Validator::make(Input::all(), $rules);
        if (!$validator->fails())//Validation
        {
            $post = new Post();
            $post->body = $request->input('body');
            $post->save();

            for ($i = 1; $i <= 3; $i++) {
                $image = $request->file('image'.$i);
                $input['imagename'] = time() . $image->getClientOriginalName();
                $destinationPath = public_path('imgs/');
                $image->move($destinationPath, $input['imagename']);
                $post->{"img" . $i} = $input['imagename'];
            }

$post->save();

        } else {
            return $validator->errors()->all();
        }


    }

    function read()
    {

    }

    function update()
    {

    }

    function delete($id)
    {

    }
}
