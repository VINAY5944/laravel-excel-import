<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ImportPeopleJob;
use Illuminate\Support\Facades\Storage;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        // Store the uploaded file in the 'imports' directory
        $filePath = $request->file('file')->store('imports');

        // Dispatch the job to process the file
        ImportPeopleJob::dispatch(Storage::path($filePath));

        // Redirect back with a success message
        return redirect()->back()->with('message', 'File uploaded successfully and import job dispatched.');
    }
}
