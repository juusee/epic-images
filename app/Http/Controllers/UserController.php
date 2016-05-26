<?php

namespace App\Http\Controllers;

use App\Domain\Services\ImageService;
use App\Domain\Services\UserService;
use App\Repositories\ImageRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $users;
    protected $images;

    public function __construct(UserRepository $userRepository, ImageRepository $imageRepository) {
        $this->middleware('auth');
        $this->users = $userRepository;
        $this->images = $imageRepository;
    }

    public function index() {
        return view('user.index');
    }

    public function show($username) {
        return view('user.index', [
            'user' => $this->users->getUserByName($username)
        ]);
    }

    public function edit(Request $request) {
        return view('user.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request, User $users) {
        if (!($request->user()->allowed('edit.users', $users, true, 'id'))) {
            return response('Unauthorized.', 401);
        }

        $users->username = $request->input('username');
        $users->email = $request->input('email');
        $users->save();
        return redirect('/users/' . $users->username);
    }

    public function destroy(Request $request, User $users) {
        if (!($request->user()->allowed('delete.users', $users, true, 'id'))) {
            return response('Unauthorized.', 401);
        }

        $this->users->destroy($users->id);

        return redirect('/');
    }
}
