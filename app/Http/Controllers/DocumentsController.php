<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Document;
use App\User; 
use App\SendCode;

class DocumentsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docs = Document::orderBy('created_at','desc')->paginate(5);
        return view('documents.index')->with('docs', $docs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'body' => 'required',
            'cover_file' => 'nullable|max:2999'
        ]);
        $user = User::find(auth()->user()->id);

        //Handle file upload
        if($request->hasFile('cover_file')){
            // Get filename with the extention 
            $fileNameWithExt = $request->file('cover_file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extention = $request->file('cover_file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extention;
            // Upload Image
            $path = $request->file('cover_file')->storeAs('public/cover_files', $fileNameToStore);
        } else {
            $fileNameToStore = '';
        }

        //Create doc
        $doc = new Document;
        $doc->title = $request->input('title');
        $doc->body = $request->input('body');
        $doc->user_id = auth()->user()->id;
        $doc->cover_file = $fileNameToStore;
        $doc->code = SendCode::sendCode($user->phone_number);
        $doc->save();

        return redirect('/verifydoc')->with('success', 'Домумент создан!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doc = Document::find($id);
        $user_id = auth()->user()->id; 
        $user = User::find($user_id);

        //check for existence of document
        if(!$doc){
            return redirect('/documents')->with('error', 'Документ не существует');
        }
       
        return view('documents.show')->with('doc', $doc);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doc = Document::find($id);
        $user_id = auth()->user()->id; 
        $user = User::find($user_id);

        //check for existence of document
        if(!$doc){
            return redirect('/documents')->with('error', 'Документ не существует');
        }

        //Check fpr correct user
        if($user_id !== $doc->user_id){
            return redirect('/documents')->with('error', 'Неавторизированный пользователь');
        }

        return view('documents.edit')->with('doc', $doc);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        //Handle file upload\
        if($request->hasFile('cover_file')){
            // Get filename with the extention 
            $fileNameWithExt = $request->file('cover_file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extention = $request->file('cover_file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extention;
            // Upload Image
            $path = $request->file('cover_file')->storeAs('public/cover_files', $fileNameToStore);
        }


        $doc = Document::find($id);
        $user = User::find(auth()->user()->id);

        $doc->title = $request->input('title');
        $doc->body = $request->input('body');
        if($request->hasFile('cover_file')){
            $doc->cover_file = $fileNameToStore;   
        }
        $doc->code = SendCode::sendCode($user->phone_number);
        $doc->save();

        return redirect('/verifydoc');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doc = Document::find($id);
        $user_id = auth()->user()->id; 

        
        //check for existence of document
        if(!$doc){
            return redirect('/documents')->with('error', 'Документ не существует');
        }

        //Check fpr correct user
        if($user_id !== $doc->user_id){
            return redirect('/documents')->with('error', 'Неавторизированный пользователь');
        }

        if ($doc->cover_file !== '') {
            // Delete File
            Storage::delete('public/cover_files/'.$doc->cover_file);

        }

        $doc->delete();
        return redirect('/documents')->with('success', 'Домумент удалён!'); 
    }

       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verificate($id)
    {
        $doc = Document::find($id);
        $user = User::find(auth()->user()->id);      

        $doc->code = SendCode::sendCode($user->phone_number);
        $doc->save();

        return redirect('verifydoc');
    }

}
