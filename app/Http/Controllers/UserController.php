<?php

namespace App\Http\Controllers;

use App\User;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $users;
    protected $images;

    public function __construct(UserRepository $users, ImageRepository $images) {
        $this->middleware('auth');
        $this->users = $users;
        $this->images = $images;
    }

    public function index() {
        return view('user.index');
    }

    public function show(Request $request, $username) {
        return view('user.index', [
            'user' => $this->users->getUserByName($username),
        ]);
    }

    public function edit(Request $request) {
        return view('user.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request) {
        $user = $request->user();
        $user->username = $request->input('username');
        $user->email= $request->input('email');
        $user->save();
        return redirect('user/' . $request->user()->username . '/edit');
    }

    public function destroy(Request $request, User $user) {
        $this->authorize('destroy', $user);

        $images = $this->images->getUserImages($user);

        foreach ($images as $image) {
            unlink('images/' . $image->id . '.' . $image->extension);
            $image->delete();
        }

        $user->delete();

        return redirect('/');
    }
}
