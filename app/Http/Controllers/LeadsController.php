<?php

namespace App\Http\Controllers;

use App\Events\Bitrix\OnAddLead;
use App\Http\Requests\SaveLeadRequest;
use App\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

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
     * @return View
     */
    public function index()
    {
        $leads = $this->lead->getLeadsToVue(10);
        return view('leads', compact('leads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaveLeadRequest $request
     * @return RedirectResponse
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

        $data = [
            'title' => $validated->get('lead_name') .
                " add a car:" . $validated->get('car_mark') .
                " " . $validated->get('car_model') .
                " (" . $validated->get('car_category') . ")",
            'name' => $validated->get('lead_name'),
            'phone' => $validated->get('lead_phone'),
            'email' => $validated->get('lead_mail')
        ];

        event(new OnAddLead($data));

        return back()->with('success', __('main.LEAD_CREATED'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Lead $lead
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return response()->json($lead->getLeadsToVue(10));
    }
}
