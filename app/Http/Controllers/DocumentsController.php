<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\User; 

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docs = Document::orderBy('id', 'asc')->paginate(10);
        $user_id = auth()->user()->id; 
        $user = User::find($user_id);
        return view('documents.index')->with('docs', $user->documents);
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
            'title' => 'required',
            'body' => 'required'
        ]);

        $doc = new Document;
        $doc->title = $request->input('title');
        $doc->body = $request->input('body');
        $doc->user_id = auth()->user()->id;
        $doc->save();

        return redirect('/documents')->with('success', 'Домумент создан!');
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

        $doc = Document::find($id);
        $doc->title = $request->input('title');
        $doc->body = $request->input('body');
        $doc->save();

        return redirect('/documents')->with('success', 'Изменения сохранены!');
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
        $doc->delete();
        return redirect('/documents')->with('success', 'Домумент удалён!'); 
    }
}