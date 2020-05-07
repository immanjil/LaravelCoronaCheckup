<?php

namespace App\Http\Controllers;
use App\Patient;
use App\Http\Resources\Patient as PatientResource;
use App\Http\Resources\PatientCollection;

use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function index()
    {
        return new PatientCollection(Patient::all());
    }

    public function show($id)
    {
        return new PatientResource(Patient::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $Patient = Patient::create($request->all());

        return (new PatientResource($Patient))
            ->response()
            ->setStatusCode(201);
    }

    public function answer($id, Request $request)
    {
        $request->merge(['correct' => (bool) json_decode($request->get('correct'))]);
        $request->validate([
            'correct' => 'required|boolean'
        ]);

        $Patient = Patient::findOrFail($id);
        $Patient->answers++;
        $Patient->points = ($request->get('correct')
            ? $Patient->points + 1
            : $Patient->points - 1);
        $Patient->save();

        return new PatientResource($Patient);
    }

    public function delete($id)
    {
        $Patient = Patient::findOrFail($id);
        $Patient->delete();

        return response()->json(null, 204);
    }

    public function resetAnswers($id)
    {
        $Patient = Patient::findOrFail($id);
        $Patient->answers = 0;
        $Patient->points = 0;

        return new PatientResource($Patient);
    }}
