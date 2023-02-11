<?php

namespace App\Exports;

use App\Models\Inventory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class inventorysImport implements FromView, ShouldAutoSize, WithEvents, ShouldQueue

// class ReportOfflineExport implements FromView, ShouldAutoSize, WithEvents, ShouldQueue

{

    public function view(): View
    {

        $items = Inventory::with(['user', 'elements', 'store'])
            ->where('id', request()->get('id'))->OrderBy('id', 'desc')->first();
        return view('exports.inventory', compact('items'));
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:EZ1'; // All headers
                $cells = $event->sheet->getDelegate()->getCellCollection();

                $event->sheet->getDelegate()->getStyle($cellRange);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);

                foreach ($cells as $cell) {
                    $event->sheet->getDelegate()->getColumnDimension($cell)->setWidth(0.90);
                }
            },
        ];
    }
}
