<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    /*
        Display a listing of the resource.
        @return \Illuminate\Http\Response
    */
    public function index()
    {
        //Fetch all manga from database
        $mangas = Manga::all();
        return view('manga.list', ['mangas' => $mangas]);
    }

    /*
        Display MAL Database
    */
    public function showDatabase()
    {
        //
    }

    /*
        Process new manga
    */
    public function create(Request $request)
    {
        Manga::create([
            'mal_id' => $request->mal_id,
            'eng_title' => $request->eng_title,
            'author' => $request->author,
            'run_start' => $request->run_start,
            'run_end' => $request->run_end,
            'status' => $request->status
        ]);
        return redirect('manga.list');
    }

    public function updateStatus(Request $request, Manga $manga)
    {
        $manga->update([
            'status' => $request->status
        ]);

        return redirect('manga.list');
    }

    public function destroy(Manga $manga)
    {
        $manga->delete();
        return redirect('manga.list');
    }
}