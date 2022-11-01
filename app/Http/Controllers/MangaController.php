<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;
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
        $mangas = Manga::orderBy('created_at', 'ASC')->get();
        return view('welcome', ['mangas' => $mangas]);
    }

    /*
        Display MAL Database
    */
    public function search(Request $request)
    {
        //Get page number for search page
        $page = $request->get('page', 1);

        if ($request->has('q'))
        {
            $q = $request->input('q');
            $response = Http::get("https://api.jikan.moe/v4/manga?letter=$q&limit=10&page=$page");
        }
        else
        {
            $response = Http::get("https://api.jikan.moe/v4/manga?limit=10&page=$page");
        }
        
        $mangas = json_decode($response->body())->data;
        $pagination = json_decode($response->body())->pagination;

        if (isset($q))
        {
            return view('search', compact('mangas', 'pagination', 'page', 'q'));
        }
        else
        {
            return view('search', compact('mangas', 'pagination', 'page'));
        }
    }

    /*
        Process new manga
    */
    public function create(Request $request)
    {
        $message = "";
        //Check if manga is already added in list
        if (Manga::where('mal_id', (int) $request->mal_id)->exists())
        {
            $message = "Manga already in list";
        }
        else
        {
            //Attempt to create record
            try
            {
                //Use create method to add to database using request information.
                Manga::create([
                    'mal_id' => (int) $request->mal_id,
                    'eng_title' => $request->eng_title,
                    'jp_title' => $request->jp_title,
                    'author' => $request->author,
                    'run_start' => $request->run_start,
                    'run_end' => $request->run_end,
                    'status' => $request->status
                ]);
            } 
            catch (Exception $e)
            {
                $message =  "Faied to add manga!";
            }
        }
        
        return redirect('/')->with('status', $message);
    }

    public function update(Request $request)
    {
        $message = "";
        //Check if record exists in database
        //https://devdojo.com/bobbyiliev/how-to-check-if-a-record-exists-with-laravel-eloquent
        if (Manga::where('id', $request->id)->exists())
        {
            //If record exists

            try
            {
                //Get record from database.
                $manga = Manga::find($request->id);

                //Change status
                $manga->status = $request->status;

                //Save change
                $manga->save(); 

                //Set message
                $message .= "Successfully updated manga!";
            }
            catch(Exception $e)
            {
                //Catch any exceptions
                $message .= "Failed to update manga!";
            }
        }
        else
        {   
            //Record does not exist

            $message .= "Manga does not exist in list.";
        }
        
        return redirect('/')->with('status', $message);
    }

    public function destroy(Request $request)
    {
        $message = "";
        //Check if record exists in database
        //https://devdojo.com/bobbyiliev/how-to-check-if-a-record-exists-with-laravel-eloquent
        if (Manga::where('id', $request->id)->exists())
        {
            //Attempt to retrieve record and delete it. 
            try
            {
                //Retrieve record
                $manga = Manga::find($request->id);

                //Delete record
                $manga->delete();

                $message .= 'Successfully removed manga!';
            }
            catch (Exception $e)
            {
                $message .= "Failed to delete manga!";
            }
        }
        else
        {
            $message .= "Manga does not exist in list to remove.";
        }
        

        return redirect('/')->with('status', $message);
    }
}