<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Http\Requests\StoreMealRequest;
use App\Http\Requests\UpdateMealRequest;
use App\Http\Resources\MealCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Rules\WithRule;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([ 
            'lang' => [Rule::in(['en','fr', 'de'])],
            'per_page' => ['integer', 'min:1'],
            'category' => ['integer', 'min:1'],
            'tags' => 'regex:/^[\d\s,]*$/',
            'diff_time' => ['numeric', 'min:1'],
            'with' => ['string', new WithRule],
            'page' => ['integer', 'min:1'],
        ]); 

        $per_page = $request->input('per_page', 10);
        $category = $request->input('category');
        $tags = $request->input('tags');
        $diff_time = $request->input('diff_time');
        $with = $request->input('with');
        $locale = $request->input('lang', 'en');

        app()->setLocale($locale);

        $query = Meal::query();

        if ($with) {
            $properties = explode(',', $with);
            foreach ($properties as $property) {
                $query->with($property);
            }
        }

        if ($category) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('id', $category);
            });
        }

        if ($tags) {
            $tagIDs = explode(',', $tags);
            foreach ($tagIDs as $tagID) {
                $query->whereHas('tags', function ($query) use ($tagID) {
                    $query->where('tags.id', $tagID);
                });
            }
        }

        if ($diff_time) {
            $time = Carbon::createFromTimestamp($diff_time);
            $query->withTrashed()->where(function ($query) use ($time) {
                $query->where('created_at', '>', $time)
                      ->orWhere('updated_at', '>', $time)
                      ->orWhere('deleted_at', '>', $time);
            });
        }
        return new MealCollection($query->paginate($per_page));
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
    public function store(StoreMealRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Meal $meal)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meal $meal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMealRequest $request, Meal $meal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meal $meal)
    {
        //
    }
}
