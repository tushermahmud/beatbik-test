<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Event;
class EventController extends Controller
{
    protected $uploadPath;
    public function __construct(){
        $this->middleware('auth:admin');

    }
    /**

     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $onlyTrashed=null;
        if($request->get('status')&&$request->get('status')=='trash'){
            $events=Event::onlyTrashed()->orderBy('created_at','desc')->paginate(5);
            $onlyTrashed=True;
            $eventCount=Event::onlyTrashed()->count();
        }
        elseif($request->get('status')&&$request->get('status')=='published'){
            $events=Event::published()->orderBy('created_at','desc')->paginate(5);
            $eventCount=Event::published()->count();
        }
        elseif($request->get('status')&&$request->get('status')=='draft'){
            $events=Event::where('published_at',0)->orderBy('created_at','desc')->paginate(5);
            $eventCount=Event::where('published_at',0)->count();
        }

        else{
            $events=Event::orderBy('created_at','desc')->paginate(5);
            $onlyTrashed=False;
            $eventCount=Event::count();
        }

        $counts=[
            'all'       =>Event::count(),
            'trashed'   =>Event::onlyTrashed()->count(),
            'published' =>Event::published()->count(),
            'draft'     =>Event::where('published_at',0)->count()
        ];
        return view('backend.event.index',compact('events','onlyTrashed','eventCount','counts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        return view('backend.event.create',compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\EventRequest $request)
    {
        $data           =$this->handleRequest($request);
        $slugarray      =explode(" ", $request->name);
        $slug           =implode("-", $slugarray);
        $data['slug']   = $slug;
        if($request->submitbutton){
            $data['published_at']=1;
        }
        elseif($request->submitdraftbutton){
            $data['published_at']=0;
        }
        Event::create($data);
        return redirect('admin/events')->with('status','The Event has been successfully added !');
    }
    private function handleRequest($request){
        $data=$request->all();
        if( $request->hasFile('image')){
            $image              =$request->file('image');
            $filename           =$image->getClientOriginalName();
            $uploadPath         =public_path('uploads');
            $destinationPath    =$uploadPath;
            $successUploaded=$image->move($destinationPath, $filename);
            $data['image']=$filename;
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event=Event::findOrFail($id);
        return view('backend.event.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\EventRequest $request, $id)
    {
        $event=Event::findOrFail($id);
        $oldImage=$event->image;
        if($oldImage!=$event->image);
        $this->removeImage($oldImage);
        $data=$this->handleRequest($request);
        if($request->submitbutton){
            $data['published_at']=1;
        }
        elseif($request->submitdraftbutton){
            $data['published_at']=0;
        }
        $event->update($data);
        return redirect('admin/events')->with('status','The event has been successfully updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event=Event::findOrFail($id);
        $event->delete();
        return redirect('admin/events')->with('trash',['The Event has been successfully deleted !',$id]);
    }
    public function restore($id){
        $event=Event::withTrashed()->findOrFail($id);
        $event->restore();
        return redirect()->back()->with('status', 'The Event has been restroed!');
    }
    public function forceDestroy($id){
        $event=Event::withTrashed()->findOrFail($id);
        $event->forceDelete();
        $this->removeImage($event->image);
        return redirect('admin/events?status=trash')->with('status', 'The event has been permanantly deleted!');
    }
    private function removeImage($image){
        $uploadPath         =public_path('uploads');
        $destinationPath    =$uploadPath;
        $imagePath     =$uploadPath .'/'.$image;
        $extention     =substr(strrchr($image,'.'),1);


        if($imagePath && file_exists(public_path('uploads').'/'.$image)) unlink($imagePath);

    }
}
