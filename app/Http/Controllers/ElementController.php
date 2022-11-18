<?php

namespace App\Http\Controllers;

use App\Http\Requests\ElementStoreRequest;
use App\Models\Element;
use App\Models\Store;
use App\Traits\Qr;
use App\Traits\Response;
use Illuminate\Support\Facades\File;

class ElementController extends Controller
{
    use Response, Qr;

    public function index(Store $store)
    {
        $items = Element::select('name', 'reference', 'id')->paginate();
        return $this->success($items);
    }

    public function get(Element $element)
    {
        return $this->success($element);
    }

    public function register(ElementStoreRequest $request)
    {
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

    public function changeStaus(Element $element)
    {

        $element->update(['status' => request('status')]);

        return $this->success(['message' => 'Element update successfully', 'item' => $element], 200);
    }

    public function getQr(Element $element)
    {
        // return File::get(public_path('/imgs/stores/' . $element->qr . '.png'));

        // return response()->file(public_path('/imgs/stores/' . $element->qr . '.png'));

        // return Image::make($storagePath)->response();
    }
}
