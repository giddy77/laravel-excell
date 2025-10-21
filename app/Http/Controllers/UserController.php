<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UserImport;
use App\Imports\UsersImport;
use App\Models\User;
use Dedoc\Scramble\Attributes\ExcludeRouteFromDocs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display all users.
     */
       #[ExcludeRouteFromDocs()]
    public function index()
    {
        $users = User::all();
        return view("users.index", compact("users"));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }

    /**
     * Import Users
     */

     public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:10240'
        ]);

        $file = $request->file('file');

        Log::info('Uploaded file info', ['file' => $file->getClientOriginalName()]);


        try {
            Excel::import(new UsersImport(), $request->file('file'));
           Log::info('CSV import completed successfully');
            return back()->with('success', 'users imported successfully!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            Log::critical('Error', ['file'=> $e->getMessage()]);
            $failures = $e->failures();
            
            return back()->with('error', 'Import failed. Please check your CSV file.');
        }
    }

    public function export()
    {
       return Excel::download(new UsersExport(), "users2.csv");
    }
}
