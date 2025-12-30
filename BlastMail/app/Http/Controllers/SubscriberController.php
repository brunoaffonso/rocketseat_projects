<?php

namespace App\Http\Controllers;

use App\Models\EmailList;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the subscribers for a specific email list.
     */
    public function index(Request $request, EmailList $emailList)
    {
        return view('subscribers.index', [
            'emailList' => $emailList,
            'subscribers' => $emailList->subscribers()
                ->when($request->show_deleted, function ($query) {
                    return $query->withTrashed();
                })
                ->when($request->search, function ($query, $search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
                })
                ->orderBy('name', 'asc')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(EmailList $emailList)
    {
        return view('subscribers.create', [
            'emailList' => $emailList,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, EmailList $emailList)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                \Illuminate\Validation\Rule::unique('subscribers')
                    ->where('email_list_id', $emailList->id)
                    ->whereNull('deleted_at'),
            ],
        ]);

        $emailList->subscribers()->create($validated);

        return to_route('subscribers.index', $emailList);
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
    public function destroy(EmailList $emailList, string $id)
    {
        $subscriber = $emailList->subscribers()->findOrFail($id);
        $subscriber->delete();

        return to_route('subscribers.index', $emailList);
    }
}
