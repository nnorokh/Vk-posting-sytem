<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\vkController;
class mainPostController extends Controller
{
   function indexPost(Request $request){
//       Vk
    $vk_response = app(vkController::class)->vkPost($request);
    return $vk_response;
   }
}
