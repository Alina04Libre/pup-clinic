<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use DB;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {

    //     $faqs_query = Faq::query();

    //     $search_param = $request->query('q');

    //     if ($search_param) {
    //         $faqs_query->where(function ($query) use ($search_param) {
    //             $query
    //                 ->orWhere('question', 'like', "%$search_param")
    //             ->orWhere('answer', 'like', "%$search_param");
    //         });
    //     }

    //     $faqs = $faqs_query->get();



    //     return view('index', compact('faqs', 'search_param'));
    // }
    public function index(Request $request)
    {
        $search_param = $request->query('q');

        if ($search_param) {
            // Find the FAQ matching the search query
            $faq = Faq::where('question', 'like', "%$search_param%")->with('answers'); //eto yung search sa question


            if ($faq) {
                // Increment the popularity
                $faq->increment('popularity');
            }

            // Perform your regular search logic here
            $faqs = Faq::search($search_param)
                       ->orderBy('popularity', 'desc')
                       ->get();
        
        } else {
            // Handle case when there's no search query
            $faqs = Faq::orderBy('popularity', 'desc')->get();
        }

        return view('index', compact('faqs', 'search_param'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
