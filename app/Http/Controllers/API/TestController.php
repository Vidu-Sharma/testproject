<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
  // app/Http/Controllers/API/TestController.php
/**
 * @SWG\Get(
 *   path="/sample",
 *   summary="Sample",
 *   @SWG\Response(response=200, description="successful operation")
 * )
 *
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    return response()->json('Ok');
}
}
