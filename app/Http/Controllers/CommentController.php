<?php

namespace App\Http\Controllers;

use App\Domain\Services\CommentService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{

    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index($image_id) {
        $comments = $this->commentService->getImageComments($image_id);
        $comments_arr = array();
        foreach ($comments as $comment) {
            array_push($comments_arr, array('id' => $comment->id, 'user' => $comment->user, 'content' => $comment->content));
        }
        return json_encode($comments_arr);
    }

    public function store(Request $request, $imageid) {
        $request->user()->comments()->create([
           'user' => $request->user()->username,
           'content' => $request->input('text'),
           'image_id' => $imageid,
        ]);
    }
}
