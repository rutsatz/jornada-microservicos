<?php

namespace App\Observers;

use App\Models\Payment;

class PaymentObserver
{
    // Observar todos os eventos de pagamento criado.
    public function created(Payment $payment)
    {
        // Toda vez que receber uma nova ordem, executa o método que criamos adjusTotal
        $payment->order->adjustTotal();
        // Atualiza o saldo devedor, pois pode ser que tenha sido adicionado um pagamento.
        $payment->order->adjustBalance();
    }

    // Obseva os eventos de ordem alterada.
    public function updated(Payment $payment)
    {
        // Toda vez que receber uma nova ordem, executa o método que criamos adjusTotal
        $payment->order->adjustTotal();
        // Atualiza o saldo devedor, pois pode ser que tenha sido adicionado um pagamento.
        $payment->order->adjustBalance();
    }

    // Quando um pagamento for removido, eu também preciso recalcular
    public function deleted(Payment $payment)
    {
        // Toda vez que receber um novo pagamento, executa o método que criamos adjusTotal
        $payment->order->adjustTotal();
        // Atualiza o saldo devedor.
        $payment->order->adjustBalance();
    }

}
