<?php

namespace App\Livewire\Patient\Documents;

use App\Models\PatientDocument;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.app')]
class DocumentUpload extends Component
{
    use WithFileUploads;

    public $documents;
    public $file;
    public $type = 'other';
    public $title;
    public $showUploadForm = false;

    protected $rules = [
        'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'type' => 'required|in:xray,lab_report,insurance,medical_certificate,other',
        'title' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->loadDocuments();
    }

    public function loadDocuments()
    {
        $this->documents = auth()->user()->documents()->orderBy('created_at', 'desc')->get();
    }

    public function upload()
    {
        $this->validate();

        $path = $this->file->store('documents/' . auth()->id(), 'public');

        PatientDocument::create([
            'patient_id' => auth()->id(),
            'type' => $this->type,
            'title' => $this->title,
            'file_path' => $path,
            'file_size' => $this->file->getSize(),
            'mime_type' => $this->file->getMimeType(),
            'uploaded_by' => auth()->id(),
        ]);

        session()->flash('success', 'Document uploaded successfully!');
        $this->reset(['file', 'title', 'type', 'showUploadForm']);
        $this->loadDocuments();
    }

    public function delete($documentId)
    {
        $document = PatientDocument::findOrFail($documentId);
        
        if ($document->patient_id !== auth()->id()) {
            session()->flash('error', 'Unauthorized action.');
            return;
        }

        // Delete file from storage
        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();
        session()->flash('success', 'Document deleted successfully!');
        $this->loadDocuments();
    }

    public function render()
    {
        return view('livewire.patient.documents.document-upload');
    }
}
