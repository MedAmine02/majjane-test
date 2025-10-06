<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //
    }

   


    public function store(Request $request, Dossier $dossier)
    {
        $this->authorize('uploadDocuments', $dossier);

        $request->validate([
            'document' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('document');
        $path = $file->store('documents', 'public');

        Document::create([
            'nom' => $file->getClientOriginalName(),
            'chemin' => $path,
            'type' => $file->getClientMimeType(),
            'taille' => $file->getSize(),
            'dossier_id' => $dossier->id,
        ]);

        return back()->with('success', 'Document uploadé avec succès.');
    }

    public function download(Document $document)
    {
        $this->authorize('view', $document->dossier);

        $filePath = storage_path('app/public/' . $document->chemin);
    
        return response()->download($filePath, $document->nom);
    }

    public function destroy(Document $document)
    {
        $this->authorize('uploadDocuments', $document->dossier);

        Storage::disk('public')->delete($document->chemin);
        $document->delete();

        return back()->with('success', 'Document supprimé avec succès.');
    }
}
