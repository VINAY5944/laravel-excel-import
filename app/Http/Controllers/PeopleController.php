<?php
namespace App\Http\Controllers;

use App\Jobs\ProcessPeopleImport;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,csv,xls',
        ]);

        $file = $request->file('excel_file')->store('temp');
        $filePath = storage_path('app/' . $file);

        ProcessPeopleImport::dispatch($filePath);

        return response()->json(['status' => 'Excel import queued']);
    }
}
