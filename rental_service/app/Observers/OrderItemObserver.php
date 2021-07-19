<?php

namespace App\Observers;

use App\Models\OrderItem;

class OrderItemObserver
{
    // Observar todos os eventos de item criada.
    public function created(OrderItem $orderItem)
    {
        // Toda vez que receber um novo item, executa o método que criamos adjusTotal
        $orderItem->order->adjustTotal();
        // Atualiza o saldo devedor, pois ao adicionar um item, é alterado o valor devido.
        $orderItem->order->adjustBalance();
    }

    // Obseva os eventos de item alterado.
    public function updated(OrderItem $orderItem)
    {
        // Toda vez que receber um novo item, executa o método que criamos adjusTotal
        $orderItem->order->adjustTotal();
        // Atualiza o saldo devedor, pois ao adicionar um item, é alterado o valor devido.
        $orderItem->order->adjustBalance();
    }

    // Quando um item for removido, eu também preciso recalcular
    public function deleted(OrderItem $orderItem)
    {
        // Toda vez que receber um novo item, executa o método que criamos adjusTotal
        $orderItem->order->adjustTotal();
        // Atualiza o saldo devedor, pois ao adicionar um item, é alterado o valor devido.
        $orderItem->order->adjustBalance();
    }

}
