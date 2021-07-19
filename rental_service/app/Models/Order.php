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

}
