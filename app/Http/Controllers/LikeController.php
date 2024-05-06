<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\LikeOperationsTrait;

class LikeController extends Controller
{
    use LikeOperationsTrait;

    public function like(Request $request)
    {
        return $this->like($request);
    }

    public function unlikeComment(Request $request, $likeId)
    {
        return $this->unlike($request, $likeId);
    }
}
