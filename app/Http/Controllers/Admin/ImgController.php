<?php

namespace App\Http\Controllers\Admin;

use App\Model\Img;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    protected $validateRoule = [
        'path' => 'required|max:100',
        'type' => 'required|max:100',
    ];

    public function index()
    {
        $list = \App\Model\Img::paginate(100);
        return view('admin.img.index', compact('list'));
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'uploadImg' => 'required|file|image|max:2000',
        ]);

        $path = $request->file('uploadImg')->store('upload');

        $img = new Img();
        $img->type='img';
        $img->path=$path;
        $img->save();

        return response()->json([
            'status'=>true,
            'img'=>$img
        ]);
    }
    public function vueIndex(Request $request)
    {
        $list = Img::paginate(28);
        return $list;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.img.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $this->validate($request, $this->validateRoule);
        unset($data['uploadImg']);

        \App\Model\Img::create($data);
        return redirect('admin/img');
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = \App\Model\Img::findOrFail($id);
        return view('admin.img.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request $request
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, $this->validateRoule);
        $data = $request->all();

        unset($data['uploadImg']);
        \App\Model\Img::findOrFail($id)->update($data);
        return redirect('admin/img');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate = \App\Model\Img::findOrFail($id);
        $cate->delete();
        return response()->json([
            'status' => true
        ]);
    }
}
