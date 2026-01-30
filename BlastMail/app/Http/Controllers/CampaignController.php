<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailsCampaign;
use App\Models\Campaign;
use App\Models\EmailList;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $campaigns = Campaign::with(['emailList', 'template'])
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            })
            ->when($request->trashed, function ($query) {
                $query->withTrashed();
            }) // Simplified: To support "only trashed" or "with trashed", logic can be refined.
            // User requirement: "checkbox to show excluded". This implies `withTrashed`.
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        $emailLists = EmailList::withCount('subscribers')->get();
        $templates = EmailTemplate::all();

        return view('campaigns.create', compact('emailLists', 'templates'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'email_list_id' => ['required', 'exists:email_lists,id'],
            'template_id' => ['nullable', 'exists:email_templates,id'],
            'track_click' => ['boolean'],
            'track_open' => ['boolean'],
            'body' => ['required', 'string'],
            'schedule_type' => ['required', 'in:now,later'],
            'send_at' => ['required_if:schedule_type,later', 'nullable', 'date', 'after:now'],
        ]);

        if ($request->schedule_type === 'now') {
            $validated['send_at'] = now();
        }

        unset($validated['schedule_type']); // Remove generic field not in DB

        $campaign = Campaign::create($validated);

        SendEmailsCampaign::dispatchAfterResponse($campaign);

        return redirect()->route('campaigns.index')
            ->with('status', 'Campaign created successfully!');
    }

    public function show(Campaign $campaign)
    {
        $campaign->load(['mails.subscriber', 'emailList', 'template']);

        // Prepare chart data (last 7 days or since campaign started)
        $performanceData = $campaign->mails()
            ->selectRaw('DATE(COALESCE(sent_at, created_at)) as date, count(*) as sent, sum(case when openings > 0 then 1 else 0 end) as opened, sum(case when clicks > 0 then 1 else 0 end) as clicked')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartData = [
            'labels' => $performanceData->pluck('date')->map(fn ($date) => \Carbon\Carbon::parse($date)->format('M d'))->toArray(),
            'opens' => $performanceData->pluck('opened')->toArray(),
            'clicks' => $performanceData->pluck('clicked')->toArray(),
        ];

        return view('campaigns.show', compact('campaign', 'chartData'));
    }

    public function edit(Campaign $campaign)
    {
        $emailLists = EmailList::withCount('subscribers')->get();
        $templates = EmailTemplate::all();

        return view('campaigns.edit', compact('campaign', 'emailLists', 'templates'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'email_list_id' => ['required', 'exists:email_lists,id'],
            'template_id' => ['nullable', 'exists:email_templates,id'],
            'track_click' => ['boolean'],
            'track_open' => ['boolean'],
            'body' => ['required', 'string'],
            'schedule_type' => ['required', 'in:now,later'],
            'send_at' => ['required_if:schedule_type,later', 'nullable', 'date', 'after:now'],
        ]);

        if ($request->schedule_type === 'now') {
            $validated['send_at'] = now();
        }

        unset($validated['schedule_type']);

        $campaign->update($validated);

        SendEmailsCampaign::dispatchAfterResponse($campaign);

        return redirect()->route('campaigns.index')
            ->with('status', 'Campaign updated successfully!');
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return redirect()->route('campaigns.index')
            ->with('status', 'Campaign deleted successfully!');
    }

    public function test(Campaign $campaign)
    {
        SendEmailsCampaign::dispatch($campaign);

        return back()->with('status', 'Test email queued!');
    }

    public function preview(Campaign $campaign)
    {
        return new \App\Mail\EmailCampaign($campaign);
    }
}
