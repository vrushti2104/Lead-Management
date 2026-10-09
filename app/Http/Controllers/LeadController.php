<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $users = User::all();
        $query = Lead::with('assignedTo','createdBy');

        if(request()->filled('status')){
            $query->where('status', request()->get('status'));
        }

        if(request()->filled('source')){
            $query->where('source', request()->get('source'));
        }

        if(request()->filled('assigned_to')){
            $query->where('assigned_to', request()->get('assigned_to'));
        }

        if(request()->ajax()){
            return DataTables::eloquent($query)
                            ->addIndexColumn()
                            ->addColumn('company', function($lead){
                                return $lead->company_name;
                            })
                            ->addColumn('assigned_user', function($lead){
                                return $lead->assignedTo ? $lead->assignedTo->name : 'Unassigned';
                            })
                            ->addColumn('created_at', function($lead){
                                return $lead->created_at->format('Y-m-d H:i:s');
                            })
                            ->addColumn('action', function($lead){
                                return view('leads.action', compact('lead'));
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }

        return view('leads.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('leads.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeadRequest $request)
    {
        $validate = $request->validated();        
        $lead = Lead::create($validate);

        return redirect()->route('leads.index')->with('success','Lead has been created successfully!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        $lead = Lead::with('assignedTo', 'createdBy')->findOrFail($lead->id);
        return view('leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        $users = User::all();
        return view('leads.edit',compact('lead','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        $validate = $request->validated();
        $lead = $lead->update($validate);

        return redirect()->route('leads.index')->with('success','Lead has been updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')->with('success','Lead has been deleted successfully!!');
    }

    public function exportCsv(Request $request)
    {
        $query = Lead::with(['assignedTo', 'createdBy']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }

        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }

        $fileName = 'leads_' . now()->format('Y-m-d_H-i-s') . '.csv';

        return response()->streamDownload(function () use ($query) {
            $file = fopen('php://output', 'w');

            fwrite($file, "\xEF\xBB\xBF");

            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Phone',
                'Company',
                'Status',
                'Source',
                'Assigned To',
                'Created By',
                'Notes',
                'Created At',
            ]);

            $query->orderBy('id')->chunk(500, function ($leads) use ($file) {
                foreach ($leads as $lead) {
                    fputcsv($file, [
                        $lead->id,
                        $lead->name,
                        $lead->email,
                        $lead->phone,
                        $lead->company_name,
                        $lead->status,
                        $lead->source,
                        $lead->assignedTo?->name ?? 'Unassigned',
                        $lead->createdBy?->name ?? 'Unknown',
                        $lead->notes,
                        $lead->created_at?->format('Y-m-d H:i:s'),
                    ]);
                }
            });

            fclose($file);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
