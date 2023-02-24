<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function content()
    {
       $subjects = auth()->user()->course->subjects;
       $content = [];
       foreach($subjects as $subject)
       {
        foreach($subject->content as $cont)
        {
            array_push($content,$cont);
        }
       }
       return Api::setResponse('content', $content);
    }

}
