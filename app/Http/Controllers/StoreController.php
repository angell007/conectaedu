<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Models\Store;
use App\Traits\Qr;
use App\Traits\Response;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Sort;

class StoreController extends Controller
{

    use Response, Qr;

    public function index()
    {
        $items = Store::select('name', 'address', 'quantity_elements')->paginate();
        return $this->success($items);
    }

    public function get(Store $store)
    {
        $store->load('elements');

        return $this->success($store);
    }

    public function register(StoreRegisterRequest $request)
    {
        $item = Store::create([
            'name' => request('name'),
            'status' => true,
            'address' => request('address'),
            'quantity_elements' => request('quantity_elements'),
        ]);
        $item->qr =  $this->generateQr("qr" . $item->id, 'stores');
        $item->save();

        return $this->success(['message' => 'Element created successfully', 'item' => $item], 201);
    }

    public function update(StoreRegisterRequest $request, Store $store)
    {

        $store->update([
            'name' => request('name'),
            'status' => request('status'),
            'address' => request('address'),
            'quantity_elements' => request('quantity_elements'),
        ]);

        return $this->success(['message' => 'Element update successfully', 'item' => $store], 200);
    }

    public function changeStaus(Store $store)
    {

        $store->update(['status' => request('status')]);

        return $this->success(['message' => 'Element update successfully', 'item' => $store], 200);
    }
}
