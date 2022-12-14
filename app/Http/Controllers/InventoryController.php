<?php

namespace App\Http\Controllers;

use App\Models\Element;
use App\Models\Inventory;
use App\Models\Store;
use App\Models\User;
use App\Traits\Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{

    use Response;

    public function register(Store $store)
    {

        $existItems = Inventory::with('elements', 'store')->where('store_id', $store->id)->latest()->first();

        $newItems = [];

        $items = request()->get("items");

        $inventory = Inventory::create([
            'store_id' => $store->id,
            'date' => Carbon::now(),
            'user_id' => 1,
            // 'user_id' => Auth::user()->id,
            'read' => 0
        ]);

        foreach ($items as $item) {

            $missing = 0;
            $alert = false;

            $id = preg_replace('/[^0-9]/', '', $item['qr']);
            array_push($newItems, $id);

            if ($existItems) {
                $oldItems = $existItems->elements()->get();
                if ($oldItem = $oldItems->find($id)) {
                    $missing = $item['quantity'] - $oldItem->quantities->quantity;
                }
            }

            if (Element::find($id)) {
                DB::table('element_inventory')->insert([
                    'element_id' => $id,
                    'inventory_id' => $inventory->id,
                    'quantity' => $item['quantity'],
                    'alert' => $alert,
                    'missing' => $missing,
                ]);
            }
        }


        if ($existItems) {
            $oldItems = $existItems->elements()->get();
            if (isset($id)) if ($oldItem = $oldItems->find($id)) $missing = $oldItem->quantities->quantity - $item['quantity'];
            $oldItemsArray = json_decode(json_encode($existItems->elements()->pluck('elements.id')), true);

            $missings =  array_diff($oldItemsArray, $newItems);

            if ($missings) {
                foreach ($missings as $value) {

                    $oldItem = $oldItems->find($value);
                    $missing = $oldItem->quantities->quantity;

                    DB::table('element_inventory')->insert([
                        'element_id' => $value,
                        'inventory_id' => $inventory->id,
                        'quantity' => 0,
                        'alert' => true,
                        'missing' => $missing,
                    ]);
                }
            }
        }


        //Comparision with old inventory
        return $this->success(['message' => 'Element update successfully'], 200);
    }

    public function update(Inventory $inventory)
    {

        $items = request()->get("items");

        $inventory->elements()->detach();

        $existItems = $inventory->load('elements', 'store');

        $newItems = [];

        $c = 0;

        foreach ($items as $item) {

            $c++;

            $missing = 0;
            $alert = false;

            $id = preg_replace('/[^0-9]/', '', $item['qr']);
            array_push($newItems, $id);

            if ($existItems) {
                $oldItems = $existItems->elements()->get();
                if ($oldItem = $oldItems->find($id)) {
                    $missing = $item['quantity'] - $oldItem->quantities->quantity;
                }
            }

            if (Element::find($id)) {
                DB::table('element_inventory')->insert([
                    'element_id' => $id,
                    'inventory_id' => $inventory->id,
                    'quantity' => $item['quantity'],
                    'alert' => $alert,
                    'missing' => $missing,
                ]);
            }
        }


        if ($existItems) {


            $oldItems = $existItems->elements()->get();
            if ($oldItem = $oldItems->find($id)) $missing = $oldItem->quantities->quantity - $item['quantity'];


            $oldItemsArray = json_decode(json_encode($existItems->elements()->pluck('elements.id')), true);

            $missings =  array_diff($oldItemsArray, $newItems);


            if ($missings) {
                foreach ($missings as $value) {

                    $oldItem = $oldItems->find($value);
                    $missing = $oldItem->quantities->quantity;

                    DB::table('element_inventory')->insert([
                        'element_id' => $value,
                        'inventory_id' => $inventory->id,
                        'quantity' => 0,
                        'alert' => true,
                        'missing' => $missing,
                    ]);
                }
            }
        }


        $inventory->updated_at = Carbon::now();
        $inventory->save();
        //Comparision with old inventory
        return $this->success(['message' => 'Inventory update successfully'], 200);
    }

    public function last(Store $store)
    {

        $items = Inventory::with('elements', 'store')->where('store_id', $store->id)->latest()->first();

        return $this->success($items, 200);
    }


    public function reportAllStores(Store $store)
    {
        $stores = Store::get(['name', 'id']);
        $inventories = [];
        $alerts = 0;
        $missings = 0;
        $storesMissings = 0;
        $storesAlerts = 0;

        foreach ($stores->pluck('id') as $store) {

            $inventory = Inventory::with('elements', 'store')->where('store_id', $store)->latest()->first();
            if ($inventory) $inventories[] = $inventory;
        }

        foreach ($inventories as $inventory) {

            $flag1 = false;
            $flag2 = false;

            foreach ($inventory['elements'] as $element) {
                if ($element->quantities->alert > 0) {
                    $alerts += 1;
                    $flag1 = true;
                }
                if ($element->quantities->missing < 0) {
                    $missings += 1;
                    $flag2 = true;
                }
            }


            if ($flag1) $storesAlerts += 1;
            if ($flag2) $storesMissings += 1;
        }


        return $this->success(['storesWithMissings' => $storesMissings, 'storesWithAlerts' => $storesAlerts,  'missings' => $missings, 'alerts' => $alerts], 200);
    }


    public function stores()
    {
        $items = Store::get(['name', 'id']);

        return $this->success($items, 200);
    }



    public function getElement($qr)
    {
        $data = null;
        $qr = preg_replace('/[^0-9]/', '', $qr);
        if ($data = Element::find($qr))
            return $this->success($data, 200);
    }


    public function unreaded()
    {
        $items = Inventory::with('user', 'elements', 'store')->where('read', 0)->get();
        return $this->success($items, 200);
    }

    public function owners($id)
    {
        $items = Inventory::with('user', 'elements', 'store')->where('user_id', $id)->OrderBy('id', 'desc')->get();
        return $this->success($items, 200);
    }

    public function myowners($id)
    {
        $items = Inventory::with('user', 'elements', 'store')->where('user_id', $id)->OrderBy('id', 'desc')->get();
        return $this->success($items, 200);
    }
}
