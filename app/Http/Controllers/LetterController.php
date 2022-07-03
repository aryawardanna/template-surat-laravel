<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Letter::paginate(10);
        $active = 'active';
        return view('dashboard', compact('data', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get category
        $categories = Category::all();
        return view('admin.letter.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'file' => 'required|mimes:pdf,doc,docx',
            'cover' => 'nullable|mimes:jpg,png'
        ]);

        $data = new Letter();

        $data->name = $request->name;
		$data->description = $request->description;
        $data->typeletter = $request->typeletter;
        $data->category_id = $request->category_id;
        $data->user_id = Auth::user()->id;

        // file upload
        if($request->file('file')) {
            $file = $request->file('file');
            $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/letter/file'), $filename);

            $data->file = $filename;
        }
        if($request->file('cover')) {
            $file = $request->file('cover');
            $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/letter/cover'), $filename);

            $data->cover = $filename;
        }

        $data->save();

        return redirect()->route('letter.index')->with('success', 'Letter berhasil disimpan');
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
        $categories = Category::all();
        $letter = Letter::find($id);
        $active = 'active';

        return view('admin.letter.edit', ['categories' => $categories, 'letter' => $letter, 'active' => $active]);
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
        $request->validate([
            'name' => 'required|min:3',
            'file' => 'nullable|mimes:pdf,doc,docx',
            'cover' => 'nullable|mimes:jpg,png'
        ]);

        $data = Letter::findOrFail($id);

        $data->name = $request->name;
		$data->description = $request->description;
        $data->typeletter = $request->typeletter;
        $data->category_id = $request->category_id;
        $data->user_id = Auth::user()->id;

        // file upload
        if($request->file('file')) {
            // cek file aldreadu remove
            if($data->file != null) {
                unlink(public_path('upload/letter/file/'.$data->file));
            }
            $file = $request->file('file');
            $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/letter/file'), $filename);

            $data->file = $filename;
        }
        if($request->file('cover')) {
            // cek file aldreadu remove
            if($data->cover != null) {
                unlink(public_path('upload/letter/cover/'.$data->cover));
            }
            $file = $request->file('cover');
            $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/letter/cover'), $filename);

            $data->cover = $filename;
        }

        $data->update();

        return redirect()->route('letter.index')->with('success', 'Letter berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $letter = Letter::find($id);
        $letter->delete();

        return redirect()->route('letter.index')->with('success', 'Letter berhasil dihapus');
    }
}
