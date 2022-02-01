<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessPaymentRequest;

class PaymentController extends Controller
{
    public function store(ProcessPaymentRequest $request)
    {
        // Factory para crear la pasarela
        // Usar pasarela para construir toda la data
        // Data: auth, payment, payer, buyer
        // La pasarela debe asignar la data con la intefaz fluida
        // Una clase de contexto ejecuta el pago
        // La clase contexto usando la pasarela interpreta la respuesta
    }
}
