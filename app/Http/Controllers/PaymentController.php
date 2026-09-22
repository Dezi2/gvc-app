<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Initialize a Paystack payment and redirect the customer.
     */
    public function payWithPaystack(Order $order)
    {
        // Safety: only allow the order owner
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $reference = 'GVC-' . strtoupper(Str::random(10));

        $order->update([
            'payment_method'    => 'paystack',
            'payment_reference' => $reference,
        ]);

        $response = Http::withToken(config('services.paystack.secret_key'))
            ->post('https://api.paystack.co/transaction/initialize', [
                'email'        => $order->email,
                'amount'       => (int) ($order->total_amount * 100), // kobo
                'reference'    => $reference,
                'callback_url' => route('payment.callback'),
                'metadata'     => [
                    'order_id'     => $order->id,
                    'order_number' => $order->order_number,
                ],
            ]);

        $body = $response->json();

        if (!($body['status'] ?? false) || empty($body['data']['authorization_url'])) {
            return redirect()->route('orders.show', $order)
                ->with('error', 'Could not start Paystack payment. Please try again.');
        }

        return redirect($body['data']['authorization_url']);
    }

    /**
     * Initialize a Flutterwave payment and redirect the customer.
     */
    public function payWithFlutterwave(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $reference = 'GVC-' . strtoupper(Str::random(10));

        $order->update([
            'payment_method'    => 'flutterwave',
            'payment_reference' => $reference,
        ]);

        $response = Http::withToken(config('services.flutterwave.secret_key'))
            ->post('https://api.flutterwave.com/v3/payments', [
                'tx_ref'          => $reference,
                'amount'          => $order->total_amount,
                'currency'        => 'NGN',
                'redirect_url'    => route('payment.callback'),
                'payment_options' => 'card,banktransfer,ussd',
                'customer'        => [
                    'email'        => $order->email,
                    'phone_number' => $order->phone,
                    'name'         => $order->full_name,
                ],
                'customizations'  => [
                    'title'       => 'GVC Order #' . $order->order_number,
                    'description' => 'Payment for your egusi order',
                ],
            ]);

        $body = $response->json();

        if (($body['status'] ?? '') !== 'success' || empty($body['data']['link'])) {
            return redirect()->route('orders.show', $order)
                ->with('error', 'Could not start Flutterwave payment. Please try again.');
        }

        return redirect($body['data']['link']);
    }

    /**
     * Handle the callback from Paystack or Flutterwave.
     */
    public function handleCallback(Request $request)
    {
        // Paystack sends "reference"; Flutterwave sends "tx_ref"
        $reference = $request->query('reference') ?? $request->query('tx_ref');

        if (!$reference) {
            return redirect()->route('home')
                ->with('error', 'Payment reference missing.');
        }

        $order = Order::where('payment_reference', $reference)->first();

        if (!$order) {
            return redirect()->route('home')
                ->with('error', 'Order not found for this payment.');
        }

        // ----- Paystack verification -----
        if ($order->payment_method === 'paystack') {
            $response = Http::withToken(config('services.paystack.secret_key'))
                ->get("https://api.paystack.co/transaction/verify/{$reference}");

            $body = $response->json();

            if (($body['status'] ?? false) && ($body['data']['status'] ?? '') === 'success') {
                $order->update([
                    'payment_status' => 'paid',
                    'status'         => 'confirmed',
                ]);

                return redirect()->route('orders.show', $order)
                    ->with('success', 'Payment confirmed! Your order is being processed.');
            }

            $order->update(['payment_status' => 'failed']);

            return redirect()->route('orders.show', $order)
                ->with('error', 'Paystack payment was not successful.');
        }

        // ----- Flutterwave verification -----
        if ($order->payment_method === 'flutterwave') {
            $transactionId = $request->query('transaction_id');

            if (!$transactionId) {
                return redirect()->route('orders.show', $order)
                    ->with('error', 'Flutterwave transaction ID missing.');
            }

            $response = Http::withToken(config('services.flutterwave.secret_key'))
                ->get("https://api.flutterwave.com/v3/transactions/{$transactionId}/verify");

            $body = $response->json();

            if (($body['status'] ?? '') === 'success'
                && ($body['data']['status'] ?? '') === 'successful'
                && ($body['data']['tx_ref'] ?? '') === $reference
            ) {
                $order->update([
                    'payment_status' => 'paid',
                    'status'         => 'confirmed',
                ]);

                return redirect()->route('orders.show', $order)
                    ->with('success', 'Payment confirmed! Your order is being processed.');
            }

            $order->update(['payment_status' => 'failed']);

            return redirect()->route('orders.show', $order)
                ->with('error', 'Flutterwave payment was not successful.');
        }

        return redirect()->route('orders.show', $order);
    }
}