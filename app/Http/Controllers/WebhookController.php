<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Relationship;
use App\Models\User;
use App\Models\UserPoint;
use App\Models\UserPoints;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebhookController extends Controller
{
    public function boldHandlePaymentStatus(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('x-bold-signature');


        if (!$this->isValidSignature($payload, $signature)) {
            return response('Invalid signature', 400);
        }

        // Responder inmediatamente con 200 OK
        response('', 200)->send();

        // Procesar el webhook en segundo plano
        $this->processWebhook(json_decode($payload, true));

        return;
    }

    private function isValidSignature($payload, $signature)
    {
        $secretKey = config('services.bold.secret_key');
        $encoded = base64_encode($payload);
        $calculatedSignature = hash_hmac('sha256', $encoded, $secretKey);

        /* dd($calculatedSignature); */

        return hash_equals($calculatedSignature, $signature);
    }

    private function processWebhook($data)
    {
        try {
            $paymentId = $data['subject'];
            $type = $data['type'];
            $orderReference = $data['data']['metadata']['reference'] ?? null;

            if (!$orderReference) {
                Log::error('Order reference not found in webhook data', $data);
                return;
            }

            $order = Order::where('public_order_number', $orderReference)->first();

            if (!$order) {
                Log::error('Order not found for public_order_number: ' . $orderReference);
                return;
            }

            switch ($type) {
                case 'SALE_APPROVED':
                    $order->updateStatusAndPayment(Order::STATUS_APPROVED, $paymentId);
                    break;
                case 'SALE_REJECTED':


                    $order->updateStatusAndPayment(Order::STATUS_REJECTED, $paymentId);
                    break;
                case 'VOID_APPROVED':
                    $order->updateStatusAndPayment(Order::STATUS_FAILED, $paymentId);
                    break;
                case 'VOID_REJECTED':
                    // Mantener el estado actual, pero registrar el intento fallido de anulación
                    Log::info('Void rejected for order: ' . $order->public_order_number);
                    break;
                default:
                    Log::warning('Unknown webhook type received: ' . $type);
                    return;
            }

            Log::info('Order ' . $order->public_order_number . ' updated. New status: ' . $order->status . ', Payment ID: ' . $order->payment_id);
        } catch (\Exception $e) {
            Log::error('Error processing webhook: ' . $e->getMessage());
        }
    }

    public function prueba()
    {
        $orderReference = "66D7F6A67643A1CE";
        $paymentId = 1;

        $order = Order::where('public_order_number', $orderReference)->firstOrFail();
        $order->updateStatusAndPayment(Order::STATUS_APPROVED, $paymentId);

        $this->updateUserPoints($order->user_id, $order->total_pts);
        $this->findBinarySponsor($order->user_id, $order->total_pts);
    }

    private function updateUserPoints($userId, $points, $pointType = 'personal_pts')
    {
        UserPoint::updateOrCreate(
            ['user_id' => $userId, 'status' => 'active'],
            [$pointType => DB::raw("$pointType + " . $points)]
        );
    }

    private function findBinarySponsor($parentId, $pts)
    {
        while (true) {
            $relationship = Relationship::where('user_id', $parentId)->first();
            // Si no se encuentra una relación o no hay padre binario, salir del bucle
            if (!$relationship || !$relationship->binary_parent_id) {
                return;
            }

            $parentId = $relationship->binary_parent_id;
            $this->updateUserPoints($parentId, $pts, 'binary_pts');
        }
    }
}
