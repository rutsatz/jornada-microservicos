<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
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
        "order_id",
        "payment_type",
        "description",
        "amount",
        "payment_date",
    ];

    // Faz o cast das minhas variáveis.
    protected $casts = [
        'payment_date' => 'date',
    ];

    // Assim que faço o meu relacionamento com ActiveRecord.
    // O meu pagamento pertence a uma ordem.
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
