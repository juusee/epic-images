<?php

namespace App\Http\Controllers;

use App\Domain\Services\ImageService;
use App\Domain\Services\UserService;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $userService;
    protected $imageService;

    public function __construct(UserService $userService, ImageService $imageService) {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->imageService = $imageService;
    }

    public function index() {
        return view('user.index');
    }

    public function show($username) {
        return view('user.index', [
            'user' => $this->userService->getUserByName($username),
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

    public function destroy(User $user) {
        $this->authorize('destroy', $user);

        $this->userService->removeUser($user);

        return redirect('/');
    }
}
