<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $persons = Person::query();

        if ($search) {
            $searchTerm = strtolower(trim($search));
            $persons = $persons->whereRaw('LOWER(TRIM(name)) LIKE ?', ["%{$searchTerm}%"])
                               ->orWhereRaw('LOWER(TRIM(age)) LIKE ?', ["%{$searchTerm}%"])
                               ->orWhereRaw('LOWER(TRIM(gender)) LIKE ?', ["%{$searchTerm}%"]);
        }

        return response()->json($persons->get());
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
        $person = Person::create($request->all());
        return response()->json($person, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        return response()->json($person);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $person)
    {
        $person->update($request->all());
        return response()->json($person);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        $person->delete();
        return response()->json(null, 204);
    }
}
