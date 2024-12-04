<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\DiscountCodeModel;
use App\Models\ShippingChargeModel;

class PaymentController extends Controller
{    
    public function cart()
    {
        $data['meta_title'] = 'Cart';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        $data['cart'] = Cart::getContent();

        return view('payment.cart', $data);
    }

    public function add_to_cart(Request $request)
    {
        $getProduct = Product::getSingle($request->product_id);
        $total = $getProduct->price;

        if (!empty($request->size_id)) {
            $size_id = $request->size_id;
            $getSize = ProductSize::getProductSize($size_id);
 
            $size_price = !empty($getSize->price) ? $getSize->price : 0;
            $total = $total + $size_price;
        } else {
            $size_id = 0;
        }

        $color_id = !empty($request->color_id) ? $request->color_id : 0;

        Cart::add([
            'id' => $getProduct->id,
            'name' => 'Product',
            'price' => $total,
            'quantity' => $request->qty,
            'attributes' => array(
                'size_id' => $size_id,
                'color_id' => $color_id,
            )
        ]);

        return redirect()->back();
    }

    public function update_cart(Request $request)
    {
        foreach ($request->cart as $cart) {
            Cart::update($cart['id'], array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $cart['quantity']
                ),
            ));
        }

        return redirect()->back();
    }

    public function cart_delete($id)
    {
        Cart::remove($id);

        return redirect()->back();
    }

    public function checkout()
    {
        $data['meta_title'] = 'Cart';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        $data['cart'] = Cart::getContent();
        $data['getShipping'] = ShippingChargeModel::getShippingChargesActive();

        return view('payment.checkout', $data);
    }

    public function apply_discount_code(Request $request) 
    {
        $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);

        if (!empty($getDiscount)) {
            $total = Cart::getSubTotal();

            if ($getDiscount->type == 'Amount') {
                $discount_amount = $getDiscount->percent_amount;
                $payable_total = $total - $discount_amount;
            } else {
                $discount_amount = ($total * $getDiscount->percent_amount) / 100;
                $payable_total = $total - $discount_amount;
            }
            
            $json['status'] =  true;
            $json['message'] = 'success';
            $json['discount_amount'] =  number_format($discount_amount, 2);
            $json['payable_total'] = $payable_total;
        } else {
            $json['status'] =  false;
            $json['message'] = 'Discount code is not valid';
            $json['discount_amount'] = '0.00';
            $json['payable_total'] = Cart::getSubTotal();
        }
        
        echo json_encode($json);
    }
}
