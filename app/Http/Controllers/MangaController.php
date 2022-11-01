<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class MangaController extends Controller
{
    /*
        Display a listing of the resource.
        @return \Illuminate\Http\Response
    */
    public function index()
    {
        //Fetch all manga from database
        $mangas = DB::table('mangas')->orderBy('created_at', 'ASC')->get();
        return view('welcome', ['mangas' => $mangas]);
    }

    /*
        Display MAL Database
    */
    public function search(Request $request)
    {
        $page = $request->get('page', 1);
        $response = Http::get('https://api.jikan.moe/v4/manga?&limit=10&page=' . $page);
        $mangas = json_decode($response->body())->data;
        $pagination = json_decode($response->body())->pagination;
        return view('search', compact('mangas', 'pagination', 'page'));
    }

    /*
        Process new manga
    */
    public function create(Request $request)
    {
        //dd($request->mal_id);
        Manga::create([
            'mal_id' => (int) $request->mal_id,
            'eng_title' => $request->eng_title,
            'jp_title' => $request->jp_title,
            'author' => $request->author,
            'run_start' => $request->run_start,
            'run_end' => $request->run_end,
            'status' => $request->status
        ]);
        return redirect('/')->with('status', 'Successfully added manga!');
    }

    public function update(Request $request)
    {
        $manga = Manga::find($request->record_id);

        $manga->status = $request->status;

        $manga->save(); 

        return redirect('/')->with('status', 'Successfully updated manga!');
    }

    public function destroy(Manga $manga)
    {
        $manga->delete();
        return redirect('manga.list');
    }
}