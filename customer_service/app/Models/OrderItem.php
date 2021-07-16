<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
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
        "product_id",
        "qtd",
        "total"
    ];

    // Faz o cast das minhas variáveis.
    protected $casts = [
        'qtd' => 'int',
        'total' => 'float'
    ];

    // Assim que faço o meu relacionamento com ActiveRecord.
    // O meu item do pedido está relacionado com um produto.
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Assim que faço o meu relacionamento com ActiveRecord.
    // O item pertence a uma ordem de serviço.
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
