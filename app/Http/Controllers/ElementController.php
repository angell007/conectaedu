<?php

namespace App\Http\Controllers;

use App\Http\Requests\ElementStoreRequest;
use App\Models\Element;
use App\Models\Store;
use App\Traits\Qr;
use App\Traits\Response;

use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ElementController extends Controller
{
    use Response, Qr;

    public function index(Store $store)
    {
        $items = Element::select('name', 'sku', 'sheet_size', 'packing', 'status', 'id')
            ->when(request()->get('name') != 'null', function ($q) {
                $q->orwhere('name', 'LIKE', request()->get('name') . "%");
            })
            ->when(request()->get('reference') != 'null', function ($q) {
                $q->orwhere('sku', 'LIKE', request()->get('name') . "%");
            })
            ->paginate(20);
        return $this->success($items);
    }

    public function get(Element $element)
    {
        return $this->success($element);
    }

    public function register(ElementStoreRequest $request)
    {

        // $elemetns = Element::all();
        // foreach ($elemetns as $elemetn) {
        //     $elemetn->qr =  $this->generateQr("qr" . $elemetn->id, 'items');
        //     $elemetn->save();
        // }

        $item = Element::create([
            'name' => request('name'),
            'status' => true,
            'reference' => request('reference'),
            // 'quantity' => request('quantity'),
            // 'store_id' => request('store_id'),
        ]);

        $item->qr =  $this->generateQr("qr" . $item->id, 'items');
        $item->save();

        return $this->success(['message' => 'Element created successfully', 'item' => $item], 201);
    }

    public function update(ElementStoreRequest $request, Element $element)
    {

        $element->update([
            'name' => request('name'),
            'reference' => request('reference'),
            'quantity' => request('quantity'),
        ]);

        return $this->success(['message' => 'Element update successfully', 'item' => $element], 200);
    }

    public function changuestatus()
    {

        $element = Element::find(request()->get('id'));

        $status = $element->status == 'activo' ? 0 : 1;
        
        $element->update(['status' => $status]);

        return $this->success(['message' => 'Element update successfully', 'item' => $element], 200);
    }


    public function downloadPdf($id)
    {
        $elemetn = Element::find($id);
        $pdf = PDF::loadView('pdfs.printqr', compact('elemetn'));
        return $pdf->download('qr.pdf');
    }
}
