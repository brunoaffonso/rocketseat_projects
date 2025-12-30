<?php

namespace App\Http\Controllers;

use App\Models\EmailList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmailListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('email-list.index', [
            'emailLists' => EmailList::query()
                ->withCount('subscribers')
                ->when($request->search, function ($query, $search) {
                    return $query->where('title', 'like', "%{$search}%");
                })
                ->orderBy('title', 'asc')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('email-list.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'listFile' => 'file|mimes:csv,txt',
        ]);

        $file = $request->file('listFile');

        DB::transaction(function () use ($request, $file) {
            $emailList = EmailList::query()->create([
                'title' => $request->title,
            ]);

            if ($file) {
                $handle = fopen($file->getRealPath(), 'r');
                $header = true;
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    if ($header) {
                        $header = false;

                        continue;
                    }

                    $validator = Validator::make([
                        'name' => $row[0] ?? null,
                        'email' => $row[1] ?? null,
                    ], [
                        'name' => 'required|string|max:255',
                        'email' => 'required|email|max:255',
                    ]);

                    if ($validator->fails()) {
                        throw new \Exception('Invalid CSV row data.');
                    }

                    if ($emailList->subscribers()->where('email', $row[1])->exists()) {
                        throw new \Exception('Duplicate email found in CSV: ' . $row[1]);
                    }

                    $emailList->subscribers()->create([
                        'name' => $row[0],
                        'email' => $row[1],
                    ]);
                }
                fclose($handle);
            }
        });

        return to_route('email-list.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmailList $emailList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmailList $emailList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmailList $emailList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailList $emailList)
    {
        //
    }
}
