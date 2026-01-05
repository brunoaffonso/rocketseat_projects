<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmailTemplateRequest;
use App\Models\EmailTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailTemplateController extends Controller
{
    public function index(Request $request): View
    {
        $query = EmailTemplate::query();

        if ($request->has('show_deleted')) {
            $query->withTrashed();
        }

        if ($request->has('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $emailTemplates = $query->latest()->paginate(10);

        return view('email-templates.index', compact('emailTemplates'));
    }

    public function create(): View
    {
        return view('email-templates.create');
    }

    public function store(StoreEmailTemplateRequest $request): RedirectResponse
    {
        EmailTemplate::create($request->validated());

        return to_route('email-templates.index')->with('success', __('Template created successfully.'));
    }

    public function show(string $id): View
    {
        $emailTemplate = EmailTemplate::withTrashed()->findOrFail($id);

        return view('email-templates.show', compact('emailTemplate'));
    }

    public function edit(EmailTemplate $emailTemplate): View
    {
        return view('email-templates.edit', compact('emailTemplate'));
    }

    public function update(StoreEmailTemplateRequest $request, EmailTemplate $emailTemplate): RedirectResponse
    {
        $emailTemplate->update($request->validated());

        return to_route('email-templates.index')->with('success', __('Template updated successfully.'));
    }

    public function destroy(EmailTemplate $emailTemplate): RedirectResponse
    {
        $emailTemplate->delete();

        return to_route('email-templates.index')->with('success', __('Template deleted successfully.'));
    }
}
