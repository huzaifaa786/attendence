<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function subjects()
    {
      $subjects =  auth()->user()->course->subjects;
      foreach($subjects as $subject)
        $subject->teacher;
      return Api::setResponse('subjects',$subjects);
    }
}
