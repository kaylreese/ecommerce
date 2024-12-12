<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\DiscountCodeModel;
use App\Models\ShippingChargeModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Stripe\Stripe;
use Illuminate\Support\Facades\Session;
use App\Mail\OrderInvoiceMail;
use App\Models\NotificationModel;
use Illuminate\Support\Facades\Mail;

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

        return redirect()->back()->with('success', 'Item successfully add in to cart.');
    }

    public function cart_delete($id)
    {
        Cart::remove($id);

        return redirect()->back()->with('success', 'Item deleted successfully.');
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
    
    public function place_order(Request $request) 
    {
        $validate = 0; $message = '';
        if (!empty(Auth::check())) {
            $user_id = Auth::user()->id;
        } else {
            if (!empty($request->is_create)) {
                $checkEmail = User::checkEmail($request->email);

                if (!empty($checkEmail)) {
                    $message = 'Your account email not verified. Please check your inbox and verified.';
                    $validate = 1;
                } else {
                    $user = new User();
                    $user->name = trim($request->first_name.' '.$request->last_name);
                    $user->email = $request->email;
                    $user->password = Hash::make($request->password);
                    $user->save();

                    $user_id = $user->id;
                }
                
            } else {
                $user_id = '';
            }
        }

        if (empty($validate)) {
            $getShipping = ShippingChargeModel::getShippingCharge($request->shipping);
            $payable_total = Cart::getSubTotal();
            $discount_amount = 0;
            $discount_code = '';

            if(!empty($request->discount_code)) {
                $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);

                if(!empty($getDiscount)) {
                    $discount_code = $getDiscount->discount_code;
                    if ($getDiscount->type == 'Amount') {
                        $discount_amount = $getDiscount->percent_amount; 
                        $payable_total = $payable_total - $discount_amount;
                    } else {
                        $discount_amount = ($payable_total * $getDiscount->percent_amount) / 100;
                        $payable_total = $payable_total - $discount_amount;
                    }
                }
            }

            $shipping_amount = !empty($getShipping->price) ? $getShipping->price : 0;
            $total_amount = $payable_total + $shipping_amount;

            $order = new OrderModel();

            if (!empty($user_id)) {
                $order->user_id = trim($user_id);
            }

            $order->order_number = mt_rand(100000000, 999999999);
            $order->first_name = trim($request->first_name);
            $order->last_name = trim($request->last_name);
            $order->company_name = trim($request->company_name);
            $order->country = trim($request->country);
            $order->address_one = trim($request->address_one);
            $order->address_two = trim($request->address_two);
            $order->city = trim($request->city);
            $order->state = trim($request->state);
            $order->postcode = trim($request->postcode);
            $order->phone = trim($request->phone);
            $order->email = trim($request->email);
            $order->notes = trim($request->notes);
            $order->discount_code = trim($discount_code);
            $order->discount_amount = trim($discount_amount);
            $order->shipping_id = trim($request->shipping);
            $order->shipping_amount = trim($shipping_amount);
            $order->total_amount = trim($total_amount);
            $order->payment_method = trim($request->payment_method);
            $order->save();
            
            foreach(Cart::getContent() as $key => $cart) {
                $order_item = new OrderItemModel();
                $order_item->order_id = $order->id;
                $order_item->product_id = $cart->id;
                $order_item->quantity = $cart->quantity;
                $order_item->price = $cart->price;

                $color_id = $cart->attributes->color_id;

                if(!empty($color_id)){
                    $getColor = Color::find($color_id);
                    $order_item->color_id = $color_id;
                    $order_item->color_name = $getColor->name;
                }

                $size_id = $cart->attributes->size_id;

                if(!empty($size_id)){
                    $getSize = ProductSize::find($size_id);
                    $order_item->size_id = $size_id ;
                    $order_item->size_name = $getSize->name;
                }

                $order_item->total_price = $cart->price * $cart->quantity;
                $order_item->save();
            }

            $json['status'] = true;
            $json['message'] = "success";
            $json['redirect'] = url('checkout/payment?order_id='.base64_encode($order->id));
        } else {
            $json['status'] = false;
            $json['message'] = $message;
        }

        echo json_encode(($json));
    }


    public function checkout_payment(Request $request) {
        if(!empty(Cart::getSubTotal()) && !empty($request->order_id)) {
            $order_id = base64_decode($request->order_id);

            $getOrder = OrderModel::getOrder($order_id);

            if (!empty($getOrder) && isset($getOrder->payment_method, $getOrder->id, $getOrder->total_amount)) {
                switch ($getOrder->payment_method) {
                    case 'cash':
                        $getOrder->is_payment = 1;
                        $getOrder->save();

                        Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));

                        $user_id = $getOrder->user_id;
                        $url = url('admin/orders/detail/'.$getOrder->id);
                        $message = 'New Order Placed #'.$getOrder->order_number;

                        try {
                            NotificationModel::insert($user_id, $url, $message);
                        } catch (\Throwable $th) {

                        }
                        
                        Cart::clear();
                        return redirect('cart')->with('success', 'Order successfully placed');
                    case 'paypal':
                        $query = [
                            'business' => 'sb-inrjw34625688@business.example.com',
                            'cmd' => '_xclick',
                            'item_name' => 'E-Commerce',
                            'no_shipping' => '1',
                            'item_number' => $getOrder->id,
                            'amount' => $getOrder->total_amount,
                            'currency_code' => 'USD',
                            'cancel_return' => url('checkout'),
                            'return' => url('paypal/success-payment'),
                        ];
                        $query_string = http_build_query($query);
                        return redirect()->away('https://www.sandbox.paypal.com/cgi-bin/webscr?' . $query_string);
                    case 'stripe':
                        Stripe::setApiKey(env('STRIPE_SECRET'));
                        $finalprice = $getOrder->total_amount * 100;

                        $session = \Stripe\Checkout\Session::create([
                            'customer_email' => $getOrder->email,
                            'payment_method_types' => ['card'],
                            'line_items' => [[
                                'price_data' => [
                                    'currency' => 'usd',
                                    'product_data' => [
                                        'name' => 'E-Commerce',
                                    ],
                                    'unit_amount' => intval($finalprice),
                                ],
                                'quantity' => 1,
                            ]],
                            'mode' => 'payment',
                            'success_url' => url('stripe/payment-success'),
                            'cancel_url' => url('checkout'),
                        ]);

                        $getOrder->stripe_session_id = $session['id'];
                        $getOrder->save();

                        $data['session_id'] = $session['id'];
                        Session::put('stripe_session_id', $session ['id']);
                        $data['setPublicKey'] = env('STRIPE_KEY');
                        $data['meta_title'] = 'Stripe Checkout';

                        return view('payment.stripecharge', $data);
                    default:
                        abort(404);
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function paypal_success_payment(Request $request) {
        // dd($request->all());
        if (!empty($request->item_number) && !empty($request->st) && $request->st == 'Completed') {
            $getOrder = OrderModel::getOrder($request->item_number);

            if (!empty($getOrder)) {
                $getOrder->is_payment = 1;
                $getOrder->payment_id = $request->tx;
                $getOrder->payment_data = json_encode($request->all());
                $getOrder->save();

                try {
                    Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
                } catch (\Throwable $th) {
                    
                }

                $user_id = $getOrder->user_id;
                $url = url('admin/orders/detail/'.$getOrder->id);
                $message = 'New Order Placed #'.$getOrder->order_number;

                NotificationModel::insert($user_id, $url, $message);

                Cart::clear();
                return redirect('cart')->with('success', 'Order successfully placed');
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    // public function paypal_success_payment(Request $request) {
    //     dd($request->all());
    //     // Verifica que PayPal haya enviado los parámetros requeridos
    //     if ($request->has('PayerID') && $request->has('paymentId')) {
    //         $payerID = $request->PayerID;
    //         $paymentID = $request->paymentId;
    
    //         // URL base de PayPal, configurable desde .env
    //         $paypalBaseUrl = env('PAYPAL_API_BASE_URL', 'https://www.sandbox.paypal.com');
    
    //         try {
    //             // Realiza una llamada GET para verificar el estado del pago
    //             $verificationUrl = "{$paypalBaseUrl}/cgi-bin/webscr?cmd=_notify-synch&tx={$paymentID}&at=" . env('PAYPAL_VERIFY_TOKEN');
    
    //             // Envía una solicitud cURL
    //             $ch = curl_init();
    //             curl_setopt($ch, CURLOPT_URL, $verificationUrl);
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //             $response = curl_exec($ch);
    //             curl_close($ch);
    
    //             // Procesa la respuesta de PayPal
    //             if ($response) {
    //                 $lines = explode("\n", $response);
    //                 $keyValues = [];
    //                 foreach ($lines as $line) {
    //                     $parts = explode("=", $line, 2);
    //                     if (count($parts) == 2) {
    //                         $keyValues[urldecode($parts[0])] = urldecode($parts[1]);
    //                     }
    //                 }
    
    //                 // Verifica el estado del pago
    //                 if (!empty($keyValues) && $keyValues['payment_status'] === 'Completed') {
    //                     $orderID = $keyValues['invoice']; // Invoice debe ser el número de pedido enviado a PayPal
    //                     $getOrder = OrderModel::getOrder($orderID);
    
    //                     if ($getOrder) {
    //                         $getOrder->is_payment = 1;
    //                         $getOrder->payment_id = $paymentID; // ID de la transacción
    //                         $getOrder->payment_data = json_encode($keyValues); // Guarda todos los datos de la transacción
    //                         $getOrder->save();
    
    //                         Cart::clear();
    //                         return redirect('cart')->with('success', 'Order successfully placed');
    //                     } else {
    //                         abort(404, 'Order not found');
    //                     }
    //                 } else {
    //                     return redirect('cart')->with('error', 'Payment not approved.');
    //                 }
    //             } else {
    //                 return redirect('cart')->with('error', 'Failed to verify payment.');
    //             }
    //         } catch (\Exception $e) {
    //             // \Log::error('PayPal Verification Error: ' . $e->getMessage());
    //             return redirect('cart')->with('error', 'Failed to verify payment.');
    //         }
    //     } else {
    //         return redirect('cart')->with('error', 'Invalid payment response.');
    //     }
    // }
    

    // public function paypal_success_payment(Request $request) {
       
    //     if (!empty($request->PayerID)) {
    //         $payerID = $request->PayerID;
    
    //         // Configura tu cliente HTTP
    //         $client = new Client();
    //         $paypalUrl = "https://api-m.sandbox.paypal.com/v1/payments/payment/"; // Sandbox
    //         // $paypalUrl = "https://api-m.paypal.com/v1/payments/payment/"; // Producción
    
    //         try {
    //             // Llama a la API para obtener detalles
    //             $response = $client->request('GET', $paypalUrl, [
    //                 'headers' => [
    //                     'Content-Type' => 'application/json',
    //                     'Authorization' => 'Bearer ' . $this->getPaypalAccessToken(), // Asegúrate de implementar esta función
    //                 ],
    //                 'query' => [
    //                     'payer_id' => $payerID,
    //                 ],
    //             ]);
    
    //             $paymentDetails = json_decode($response->getBody(), true);

    //             dd($paymentDetails);
    
    //             // Procesa la información de pago
    //             if ($paymentDetails['state'] == 'approved') {
    //                 $orderID = $paymentDetails['transactions'][0]['invoice_number']; // O ajusta según tu implementación
    //                 $getOrder = OrderModel::getOrder($orderID);
    
    //                 if ($getOrder) {
    //                     $getOrder->is_payment = 1;
    //                     $getOrder->payment_id = $paymentDetails['id']; // ID de la transacción
    //                     $getOrder->payment_data = json_encode($paymentDetails);
    //                     $getOrder->save();
    
    //                     Cart::clear();
    //                     return redirect('cart')->with('success', 'Order successfully placed');
    //                 } else {
    //                     abort(404, 'Order not found');
    //                 }
    //             } else {
    //                 return redirect('cart')->with('error', 'Payment not approved.');
    //             }
    //         } catch (\Exception $e) {
    //             // \Log::error('PayPal API Error: ' . $e->getMessage());
    //             return redirect('cart')->with('error', 'Failed to verify payment.');
    //         }
    //     } else {
    //         return redirect('cart')->with('error', 'Invalid payment response.');
    //     }
    // }

    // Función para obtener el token de acceso
    public function getPaypalAccessToken() {
        $client = new Client();
        $paypalTokenUrl = env('PAYPAL_API_BASE_URL', 'https://api-m.sandbox.paypal.com') . '/v1/oauth2/token';

        try {
            $response = $client->post($paypalTokenUrl, [
                'auth' => [env('PAYPAL_CLIENT_ID'), env('PAYPAL_SECRET')],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            return $data['access_token'];
        } catch (\Exception $e) {
            // \Log::error('PayPal Token Error: ' . $e->getMessage());
            throw new \Exception('Failed to retrieve PayPal access token.');
        }
    }


    public function stripe_success_payment(Request $request) {
        $trans_id = Session::get('stripe_session_id');
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $getdata = \Stripe\Checkout\Session::retrieve($trans_id);

        $getOrder = OrderModel::where('stripe_session_id', '=', $getdata->id)->first();

        if (!empty($getOrder) && !empty($getdata->id) && $getdata->id == $getOrder->stripe_session_id) {
            $getOrder->is_payment = 1;
            $getOrder->transaction_id = $getdata->id;
            $getOrder->payment_data = json_encode($getdata);
            $getOrder->save();

            try {
                Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
            } catch (\Throwable $th) {
                
            }

            $user_id = $getOrder->user_id;
            $url = url('admin/orders/detail/'.$getOrder->id);
            $message = 'New Order Placed #'.$getOrder->order_number;

            NotificationModel::insert($user_id, $url, $message);
            
            Cart::clear();

            return redirect('cart')->with('success', 'Order successfully placed.');
        } else {
            return redirect('cart')->with('error', 'Due to some error please try again.');
        }
    }
}