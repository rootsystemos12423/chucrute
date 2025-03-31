<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckoutOrder;
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
