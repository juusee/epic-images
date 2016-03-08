<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $imageid) {
        $request->user()->comments()->create([
           'user' => $request->user()->username,
           'content' => $request->input('comment'),
           'image_id' => $imageid,
        ]);
        return redirect('/image/' . $imageid);
    }
}
