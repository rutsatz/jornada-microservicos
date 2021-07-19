<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Digo que quero usar a minha trait de uuid, para rodar o método boot e instanciar meu campo de id toda vez
    // que criar um novo objeto.
    use Uuid;

    // Como vamos usar UUID como chave primária, preciso desativar o auto incremento, para evitar que ele tente
    // incrementar o campo de id automaticamente.
    public $incrementing = false;
    // Agora o meu campo id é do tipo string.
    protected $keyType = "string";

    // Laravel trabalha com ActiveRecord. Por isso, precisamos definir o atributo fillable, dizendo quais campos que
    // queremos manipular na base de dados.
    protected $fillable = [
        "id",
        "customer_id",
        "status",
        "downpayment", // Valor de entrada que o cliente paga
        "discount",
        "delivery_fee", // Taxa de entrega
        "late_fee", // Taxa de atraso da entrega
        "total",
        "balance", // Saldo devedor do cliente
        "order_date", // Data da ordem, retirada do produto
        "return_date" // Dava da devolução do produto
    ];

    protected $casts = [
        'order_date' => 'date',
        'return_date' => 'date',
        'total' => 'float',
        'discount' => 'float',
        'delivery_fee' => 'float',
        'late_fee' => 'float',
        'balance' => 'float',
    ];

    // Assim que faço o meu relacionamento com ActiveRecord.
    // A minha ordem de serviço podem ter vários itens.
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Assim que faço o meu relacionamento com ActiveRecord.
    // A order de serviço pertence a um cliente.
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Assim que faço o meu relacionamento com ActiveRecord.
    // A order pode ter vários pagamentos.
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Pega o valor total da ordem
    public function getTotal()
    {
        return $this->itemsTotal() + $this->late_fee + $this->delivery_fee - $this->discount;
    }

    // Pegar o valor total da order. (taxa de entrega + taxa de entrega atrasada + desconto + qtd de itens, etc)
    // Para isso, vou pegar o valor total dos itens.
    public function itemsTotal() {
        $totalItems = 0;
        // Percore todos os itens salvos no banco
        foreach ($this->items as $item)
        {
            $totalItems += $item->product->price * $item->qtd;
        }
        return $totalItems;
    }

    // Calcular o total pago
    public function totalPayments()
    {
        $total = 0;
        foreach ($this->payments as $payment)
        {
            $total += $payment->amount;
        }
        return $total;
    }

    // Calcular o saldo devedor
    public function adjustBalance()
    {
        // Verifica se o balance já está correto, para não precisar ficar toda hora alterando no banco de dados.
        // Então somente atualiza o balance se ele tiver mudado
        if ($this->balance != $this->getTotal() - $this->totalPayments())
        {
            $this->balance = $this->getTotal() - $this->totalPayments();
            $this->save();
        }
    }

    // Toda vez que adicionar ou alterar um item, precisa atualizar o valor total da ordem.
    public function adjustTotal()
    {
        if ($this->total != $this->getTotal())
        {
            $this->total = $this->getTotal();
            $this->save();
        }
    }

}
