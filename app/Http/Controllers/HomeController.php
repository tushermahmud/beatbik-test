<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use Illuminate\Http\Request;
use GuzzleHttp\Message\Response;
use App\Event;
use DB;
class HomeController extends Controller
{
    public function __construct(){
    }
    public function index(){
        $empty="";
        $events=Event::published()->orderBy('created_at','asc')->simplePaginate(2);
        $recents=Event::published()->orderBy('created_at','asc')->limit(4)->get();
        return view('welcome',compact('events','recents','empty'));
    }
    public function contact(){
        return view('contact');
    }
    public function blogSearch(Request $request){
        $blogs=Blog::where('name', 'LIKE',"%{$request->search}%")->orWhere('available', 'LIKE', "%{$request->search}%")->paginate(3);
        $empty="";

        if($blogs->count()<1){
            $empty="No event available with this key word!";
        }
        return view('welcome',compact('blogs','empty'));
    }
}
