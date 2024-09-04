<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }
    public function payment(Order $order)
    {
        $apiKey = config('services.bold.api_key');
        $secretKey = config('services.bold.secret_key');
        $currency = 'COP';
        /* $amount = intval($order->total * 100); */
        $amount = $order->total;
        $orderId = $order->public_order_number;

        $boldHashString = "{$orderId}{$amount}{$currency}{$secretKey}";
        $boldIntegritySignature = hash('sha256', $boldHashString);

        $boldCheckoutConfig = [
            'orderId' => $orderId,
            'currency' => $currency,
            'amount' => $amount,
            'apiKey' => $apiKey,
            'integritySignature' => $boldIntegritySignature,
            'description' => "Pago",
            /* 'tax' => 'vat-19', */
            'redirectionUrl' => config('services.bold.redirection_url'),
        ];

        return view('orders.payment', compact('order', 'boldCheckoutConfig'));
    }

    public function boldResponsePayment(Request $request)
    {
        $orderId = $request->input('bold-order-id');
        $status = $request->input('bold-tx-status');

        // Aquí puedes manejar la lógica según el estado de la transacción
        switch ($status) {
            case 'approved':
                $message = '¡Gracias por tu compra! Tu transacción ha sido aprobada.';
                // Puedes agregar más lógica, como enviar un correo de confirmación o actualizar el estado de la orden en la base de datos
                break;

            case 'processing': 
                $message = 'Tu transacción está en proceso. Te notificaremos cuando se complete.';
                break;

            case 'pending':
                $message = 'Tu transacción está pendiente. Te notificaremos cuando se confirme.';
                break;

            case 'rejected':
                $message = 'Lo sentimos, tu transacción ha sido rechazada. Por favor, intenta nuevamente.';
                break;

            case 'failed':
                $message = 'Hubo un error en tu transacción. Por favor, intenta nuevamente.';
                break;

            default:
                $message = 'Estado de la transacción desconocido. Por favor, contacta con soporte.';
                break;
        }

        return view('orders.boldResponse', compact('orderId', 'status', 'message'));
    }
}
