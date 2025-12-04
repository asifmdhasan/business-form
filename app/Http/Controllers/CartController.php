<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Variant;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    private function cartSession(Request $request, $cartName)
    {
        $validator = Validator::make($request->all(), [
            'product_id'        => 'required',
            'request_quantity'  => 'required|numeric',
            'unit_price'        => 'required|numeric',
            'total_amount'      => 'required|numeric',
        ]);
        // if ($validator->fails()) {
        //     notify()->error("All Fields are Required");
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $partVariant = Variant::with('part' , 'attribute')->find($request->variant_id);


        if ($partVariant) {
            $variantId = $request->variant_id;

            $cartItem = [
                'created_by'        => auth()->id(),
                'part_id'           => $request->product_id,
                'part_name'         => $partVariant->part->part_name,
                'variant_id'        => $variantId,
                'variant_name'      => $partVariant->value,
                'request_quantity'  => $request->request_quantity,
                'unit_price'        => $request->unit_price,
                'subtotal'          => $request->subtotal,
            ];

            if (session()->has($cartName)) {
                $dealerCart = session()->get($cartName);

                if (array_key_exists($variantId, $dealerCart)) {
                    // Update quantity and subtotal
                    $dealerCart[$variantId]['request_quantity'] += $cartItem['request_quantity'];
                    $dealerCart[$variantId]['unit_price'] = $cartItem['unit_price'];
                    $dealerCart[$variantId]['subtotal'] = $dealerCart[$variantId]['unit_price'] * $dealerCart[$variantId]['request_quantity'];
                } else {
                    // Add new item
                    $dealerCart[$variantId] = $cartItem;
                    session()->put($cartName, $dealerCart);
                    return "created";
                }

                session()->put($cartName, $dealerCart);
                return "updated";
            } else {
                // First item in cart
                session()->put($cartName, [$variantId => $cartItem]);
                return "created";
            }
        }
        return "not found";
    }

    public function store(Request $request)
    {
        $cartResult = $this->cartSession($request, "purchaseCart");
        if ($cartResult == 'created') {
            return redirect()->back()->with('success', __('layouts.item_added_to_cart'));
        } elseif ($cartResult == 'updated') {
            return redirect()->back()->with('success',  __('layouts.cart_item_updated'));
        } else {
            return redirect()->back()->with('error', __('layouts.part_not_found'));
        }
    }

    public function edit($variant_id)
    {
        $cart = session()->get('purchaseCart');
        if (!$cart || !isset($cart[$variant_id])) {
            return redirect()->back()->with('error', __('layouts.cart_item_not_found'));
        }

        $item = $cart[$variant_id];
        $parts = Part::all();
        $variants = Variant::where('part_id', $item['part_id'])->get();

        return view('cart.edit', compact('item', 'parts', 'variants', 'variant_id'));
    }

    public function update(Request $request, $variant_id)
    {
        $request->validate([
            'product_id' => 'required|exists:parts,id',
            'variant_id' => 'required|exists:variants,id',
            'request_quantity' => 'required|numeric|min:1',
            'unit_price' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ]);

        $cart = session()->get('purchaseCart');
        
        if (!$cart || !isset($cart[$variant_id])) {
            return redirect()->route('purchase.index')->with('error', __('layouts.part_not_found'));
        }

        $variant = Variant::with('part')->find($request->variant_id);

        $cart[$variant_id] = [
            
            'created_by' => auth()->id(),
            'part_id' => $request->product_id,
            'part_name' => $variant->part->part_name,
            'variant_id' => $request->variant_id,
            'variant_name' => $variant->value,
            'request_quantity' => $request->request_quantity,
            'unit_price' => $request->unit_price,
            'subtotal' => $request->subtotal,
        ];
        // dd($cart[$variant_id]);
        session()->put('purchaseCart', $cart);
        return redirect()->back()->with('success',  __('layouts.cart_item_updated'));
    }

    private function sessionDestroy($id, $cartName)
    {
        $CartSession = session()->get($cartName);

        unset($CartSession[$id]);

        session()->put($cartName, $CartSession);
    }

    public function destroy($id)
    {
        $this->sessionDestroy($id, "purchaseCart");
        return redirect()->back()->with('success', __('layouts.cart_has_been_cleared_successfully'));
    }

    public function dealerStore(Request $request)
    {
        $this->cartSession($request, "dealerCart");
        return redirect()->back();
    }

    public function dealerCartDestroy($id)
    {
        $this->sessionDestroy($id, "dealerCart");
        return redirect()->back();
    }

    public function retailerStore(Request $request)
    {
        $this->cartSession($request, "retailerCart");
        return redirect()->back();
    }
    
    public function retailerCartDestroy($id)
    {
        $this->sessionDestroy($id, "retailerCart");
        return redirect()->back();
    }
    
}
