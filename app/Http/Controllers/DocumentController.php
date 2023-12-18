<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    //
    public function ShowDocumentUser()
    {
        $documents = Document::with('user')->get();
        $user = Auth::user();

        return view('admin.document.document-user', compact('documents', 'user'));

    }
}
