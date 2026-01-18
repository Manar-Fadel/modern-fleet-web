<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreAttachmentTypeRequest;
use App\Models\AttachmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentTypeController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $q = AttachmentType::query();

        if ($request->filled('search')) {
            $search = trim($request->search);
            $q->where(function ($qq) use ($search) {
                $qq->where('name_en', 'like', "%{$search}%")
                    ->orWhere('name_ar', 'like', "%{$search}%");
            });
        }

        $types = $q->latest()->paginate(10)->withQueryString();

        return view('cpanel.attachment-types.index', compact('types'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $type = new AttachmentType();
        return view('cpanel.attachment-types.create', compact('type'));
    }

    public function store(StoreAttachmentTypeRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('attachment-types', 'public');
        }

        AttachmentType::create($data);

        return redirect()
            ->route('admin.attachment-types.index')
            ->with('success', 'Attachment type created successfully.');
    }

    public function edit(AttachmentType $attachment_type): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $type = $attachment_type;
        return view('cpanel.attachment-types.edit', compact('type'));
    }

    public function update(StoreAttachmentTypeRequest $request, AttachmentType $attachment_type): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            // حذف القديم (اختياري)
            if (!empty($attachment_type->icon) && Storage::disk('public')->exists($attachment_type->icon)) {
                Storage::disk('public')->delete($attachment_type->icon);
            }

            $data['icon'] = $request->file('icon')->store('attachment-types', 'public');
        }

        $attachment_type->update($data);

        return redirect()
            ->route('admin.attachment-types.index')
            ->with('success', 'Attachment type updated successfully.');
    }

    public function destroy(AttachmentType $attachment_type): \Illuminate\Http\RedirectResponse
    {
        // Soft delete
        $attachment_type->delete();

        return redirect()
            ->route('admin.attachment-types.index')
            ->with('success', 'Attachment type deleted successfully.');
    }
}
