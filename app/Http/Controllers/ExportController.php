<?php

namespace App\Http\Controllers;

use App\Exports\inventorysImport;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        $item = Inventory::with('user')->where('id', request()->get('id'))->first();


        $headers = [
            'Content-Disposition' => 'File Transfer',
            'Content-Description' => 'File 123  Transfer',
        ];

        return Excel::download(new inventorysImport, 'inventory- '. $item->user->name . '.xlsx', null, $headers);
    }
}
