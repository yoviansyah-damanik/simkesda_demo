<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends BackendController
{
    public function index()
    {
        $data = Slider::paginate(10)
            ->withQueryString();

        return view('backend.pages.slider.index', compact('data'));
    }

    public function create()
    {
        return view('backend.pages.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'file' => 'required|max:2048|image|dimensions:ratio=16/9',
                'priority' => 'required|min:1|max:9',
                'title' => 'nullable|max:255|required_with:description',
                'description' => 'nullable|max:255|required_with:title'
            ],
            [],
            [
                'priority' => 'Prioritas',
                'title' => 'Judul Slider',
                'description' => 'Deskripsi'
            ]
        );

        $file = $request->file;
        $filename = date('YmdHis') . '.' . $file->extension();
        $path = $file->storeAs('slider', $filename, 'public');

        $new_slider = new Slider;
        $new_slider->path = $path;
        $new_slider->priority = $request->priority;
        $new_slider->title = $request->title;
        $new_slider->description = $request->description;
        $new_slider->save();

        Alert::success('Sukses!', 'Berhasil menambahkan slider.');
        return redirect()
            ->route('dashboard.slider');
    }

    public function edit(Slider $slider)
    {
        return view('backend.pages.slider.edit', compact('slider'));
    }

    public function update(Slider $slider, Request $request)
    {
        $request->validate(
            [
                'file' => 'nullable|max:2048|image|dimensions:ratio=16/9',
                'priority' => 'required|min:1|max:9',
                'title' => 'nullable|max:255|required_with:description',
                'description' => 'nullable|max:255|required_with:title'
            ],
            [],
            [
                'priority' => 'Prioritas',
                'title' => 'Judul Slider',
                'description' => 'Deskripsi'
            ]
        );

        $file = $request->file;
        if ($file) {
            Storage::delete($slider->image_path);

            $filename = date('YmdHis') . '.' . $file->extension();
            $path = $file->storeAs('slider', $filename, 'public');

            $slider->path = $path;
        }

        $slider->priority = $request->priority;
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->save();

        Alert::success('Sukses!', 'Berhasil memperbaharui slider.');
        return redirect()
            ->route('dashboard.slider');
    }

    public function destroy(Slider $slider)
    {
        Storage::delete($slider->path);
        $slider->delete();

        Alert::success('Sukses!', 'Berhasil menghapus slider.');
        return redirect()
            ->route('dashboard.slider');
    }
}
