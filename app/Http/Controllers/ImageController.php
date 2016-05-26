<?php

namespace App\Http\Controllers;

use App\Image;
use App\Repositories\CommentRepository;
use App\Repositories\ImageRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class ImageController extends Controller {
    protected $images;
    protected $users;
    protected $comments;

    public function __construct(ImageRepository $images, UserRepository $users, CommentRepository $comments) {
        $this->images = $images;
        $this->users = $users;
        $this->comments = $comments;
    }

    public function index($page = 1) {
        return view('welcome' , [
            'images' => $this->images->getImages(Config::get('myConfig.imagesPerPage'))
        ]);
    }

    public function userImages($username) {
        $this->middleware('auth');
        $user = $this->users->getUserByName($username);
        return view('user.images', [
            'user' => $user,
            'images' => $this->images->getUserImages($user->id),
        ]);
    }

    public function show($id) {
        $image = $this->images->getImage($id);
        return view('image.show', [
            'user' => $this->users->getUserById($image->user_id),
            'image' => $image,
        ]);
    }

    public function store(Request $request) {
        $this->middleware('auth');
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'file' => 'image|max:3000',
            ]);

            $file = $request->file('image');

            $destinationPath = 'imgs/';

            $extension = $file->getClientOriginalExtension();

            $image = $request->user()->images()->create([
                'extension' => $extension,
                'description' => $request->input('description'),
            ]);

            $fileName = $image->id . '.' . $extension;

            $upload_success = $file->move($destinationPath, $fileName);

            if ($upload_success) {
                return redirect('images/' . $image->id);
            } else {
                $this->images->destroy($image->id);
                return redirect('users/' . $request->user()->username . '/imageupload')->with('message', 'Something wrong with image upload');
            }
        }
        return redirect('users/' . $request->user()->username . '/imageupload')->with('message', 'Choose file to upload!');
    }

    public function destroy(Request $request, Image $images) {
        $this->middleware('auth');
        if (!($request->user()->allowed('delete.images', $images))) {
            return response('Unauthorized.', 401);
        }

        $user = $this->users->getUserById($images->user_id);
        $this->images->destroy($images->id);

        return redirect('users/' . $user->username . '/images');
    }
}
