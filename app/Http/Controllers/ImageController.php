<?php

namespace App\Http\Controllers;

use App\Domain\Services\ImageService;
use App\Image;
use App\Repositories\CommentRepository;
use App\Repositories\ImageRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class ImageController extends Controller
{

    protected $imageService;
    protected $images;
    protected $users;
    protected $comments;

    public function __construct(ImageService $imageService, ImageRepository $images, UserRepository $users, CommentRepository $comments) {
        $this->imageService = $imageService;
        $this->images = $images;
        $this->users = $users;
        $this->comments = $comments;
    }

    public function index(Request $request) {

    }

    public function userImages($username) {
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
            //'comments' => $this->comments->getImageComments($image->id),
        ]);
    }

    public function store(Request $request) {

        $this->middleware('auth');
        if ($request->hasFile('image')) {

            $image = $request->user()->images()->create([
                'extension' => 'temp',
                'description' => $request->input('description'),
            ]);

            $this->validate($request, [
                'file' => 'image|max:3000',
            ]);

            $file = $request->file('image');

            $destinationPath = 'images/';

            $extension = $file->getClientOriginalExtension();
            $image->extension = $extension;
            $image->save();

            $fileName = $image->id . '.' . $extension;

            $upload_success = $file->move($destinationPath, $fileName);

            if ($upload_success) {
                return redirect('image/' . $image->id);
            } else {
                return redirect('user/' . $request->user()->username . '/imageupload')->with('message', 'Something wrong with image upload');
            }
        }
        return redirect('user/' . $request->user()->username . '/imageupload')->with('message', 'Choose file to upload!');
    }

    public function destroy(Request $request, Image $image) {
        $this->authorize('destroy', $image);

        $this->imageService->removeImage($image);

        return redirect('user/' . $request->user()->username . '/images');
    }
}
