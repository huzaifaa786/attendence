<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function content(Request $request)
    {
        $content = Content::where('subject_id',$request->subject_id)->get();
       return Api::setResponse('content', $content);
    }

}
