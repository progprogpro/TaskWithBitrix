<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveLeadRequest;
use App\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class LeadsController extends Controller
{

    protected $lead;

    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leads = $this->lead->getLeadsToVue(10);

        return view('leads', compact('leads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveLeadRequest $request)
    {
        $validated = collect($request->validated());

        $this->lead->create($validated->only([
            'lead_name',
            'lead_phone',
            'lead_mail'
        ])->toArray())
            ->autoria()
            ->create($validated->only([
                'car_mark',
                'car_category',
                'car_model'
            ])->toArray());

        return back()->with('success',__('main.LEAD_CREATED'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();

        return response()->json($lead->getLeadsToVue(10));

    }
}
