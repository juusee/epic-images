<?php

namespace App\Http\Controllers;

use App\Domain\Services\CommentService;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{

    protected $comments;

    public function __construct(CommentRepository $commentRepository) {
        $this->comments = $commentRepository;
    }

    public function index($image_id) {
        $comments = $this->comments->getImageComments($image_id);
        $res = ['comments' => $comments];
        return json_encode($res);
    }

    public function store(Request $request, $image_id) {
        $this->middleware('auth');
        $comment = $request->user()->comments()->create([
           'user' => $request->user()->username,
           'content' => $request->input('  '
           ),
           'image_id' => $image_id
        ]);
        $res = ['comment' => $comment];
        return json_encode($res);
    }
}
