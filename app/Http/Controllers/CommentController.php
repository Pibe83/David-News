<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\LikeOperationsTrait;
use App\Http\Controllers\Traits\CommentOperationsTrait;

class CommentController extends Controller
{
    use CommentOperationsTrait, LikeOperationsTrait;

    public function store(Request $request)
    {
        $this->createComment($request);

        return redirect()->back()->with('success', 'Comment created successfully.');
    }
}
