<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    //
    public function ShowDocumentUser()
    {
        // Memuat dokumen beserta data pengguna, termasuk yang di-soft delete
        $documents = Document::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
        // $documents = Document::whereHas('user', function ($query) {
        //     $query->whereNull('deleted_at');
        // })->get();

        $user = Auth::user();

        return view('admin.document.document-user', compact('documents', 'user'));
    }
}
