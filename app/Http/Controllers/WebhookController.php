<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckoutOrder;
use App\Models\Checkout;
use App\Models\AppsUtmify;
use App\Events\PurchaseNotification;
use App\Mail\OrderGeneratedMail;
use App\Mail\OrderPaidMail;
use Illuminate\Support\Facades\Mail;

class WebhookController extends Controller
{
    public function payloader(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'data.externalRef' => 'required|string',
                'data.status' => 'required|string',
            ]);

            $order = CheckoutOrder::where('external_reference', $validatedData['data']['externalRef'])->first();

            if(!$order){
                return response()->json([
                    'success' => false,
                    'errors' => 'External Reference Does Not Exist In Our System',
                ], 400);
            }

            if($validatedData['data']['status'] === 'paid' && $order->status !== 'paid'){
                $order->status = 'paid';
                $order->save();

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => $authorizationHeader
                ])->post('https://melhorrastreioonline.com/api/rastreio', $request->all());

                $order_customer_data = $order->customer_data ? json_decode($order->customer_data, true) : [];

                $utmify = AppsUtmify::where('store_id', $checkout->store_id)->first();

                if($utmify && $request->data->paymentMethod === 'PIX'){

                    $checkout = Checkout::where('token', $order->checkout_token)->first();

                    $orderData = [
                        'orderId' => $order->external_reference,
                        'platform' => 'shopify',
                        'paymentMethod' => 'pix',
                        'status' => 'paid',
                        'createdAt' => date('Y-m-d H:i:s'),
                        'approvedDate' => date('Y-m-d H:i:s'),
                        'refundedAt' => null,
                        'customer' => [
                            'name' => $checkout->customer_name,
                            'email' => $checkout->customer_email,
                            'phone' => $checkout->customer_telphone,
                            'document' => $checkout->customer_taxId,
                            'country' => 'BR',
                            'ip' => $checkout->ip // Usando o IP real do cliente
                        ],
                        'products' => array_map(function($item) {
                            return [
                                'id' => '123',
                                'name' => 'PRODUTO VENDEDOR',
                                'planId' => null,
                                'planName' => null,
                                'quantity' => $item['quantity'],
                                'priceInCents' => intval($item['unitPrice'])
                            ];
                        }, $request->data->items),
                        'trackingParameters' => [
                            'src' => $checkout->metadados['src'] ?? null,
                            'sck' => $checkout->metadados['sck'] ?? null,
                            'utm_source' => $checkout->metadados['utm_source'] ?? null,
                            'utm_campaign' => $checkout->metadados['utm_campaign'] ?? null,
                            'utm_medium' => $checkout->metadados['utm_medium'] ?? null,
                            'utm_content' => $checkout->metadados['utm_content'] ?? null,
                            'utm_term' => $checkout->metadados['utm_term'] ?? null
                        ],
                        'commission' => [
                            'totalPriceInCents' => $totalPrice,
                            'gatewayFeeInCents' => 0, // Ajustar conforme gateway
                            'userCommissionInCents' => 0, // Ajustar conforme regras de comissão
                            'currency' => 'BRL'
                        ],
                        'isTest' => false,
                    ];
        
                    $response = Http::withHeaders([
                        'x-api-token' => $utmify->utmify_api_key,
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json'
                    ])->post('https://api.utmify.com.br/api-credentials/orders', $orderData);

                }

                Mail::to($order_customer_data['email'])->send(new OrderPaidMail($order));

                broadcast(new PurchaseNotification($order));

                return response()->json([
                    'success' => true,
                    'message' => 'Pagamento Recebido',
                ], 200);

            }

            return response()->json([
                'success' => true,
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        }
    }


}
