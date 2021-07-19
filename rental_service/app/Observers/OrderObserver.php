<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    // Observar todos os eventos de ordem criada.
    public function created(Order $order)
    {
        // Toda vez que receber uma nova ordem, executa o método que criamos adjusTotal
        $order->adjustTotal();
    }

    // Obseva os eventos de ordem alterada.
    public function updated(Order $order)
    {
        // Toda vez que receber uma nova ordem, executa o método que criamos adjusTotal
        $order->adjustTotal();
        // Atualiza o saldo devedor, pois pode ser que tenha sido adicionado um pagamento.
        $order->adjustBalance();
    }

}
