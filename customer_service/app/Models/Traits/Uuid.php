<?php


namespace App\Models\Traits;

/**
 * No PHP, como não tem herança múltipla, foram criadas as traits para suprir essa necessidade. Então elas são como se
 * fossem subclasses reutilizáveis, que podem ser crescidas horizontalmente.
 * Trait Uuid
 * @package App\Models\Traits
 */
trait Uuid
{

    // Eu sobrescrevo o método boot das demais classes dos meus Models.
    // Esse é um método que todos os models do Eloquent possuem.
    // Então toda vez que instanciarmos um model que usa esse uuid, ele vai rodar esse boot.
    public static function boot() {
        // Executa o boot da classe pai, no caso o método boot do próprio Eloquent.
        parent::boot();

        // Preciso iniciar o meu campo ID se ele estiver vazio.
        // Executo uma função quando ele está criando o objeto. Essa função recebe o objeto por parâmetro.
        static::creating(function ($obj) {
            if (!$obj->id) {
                $obj->id = \Ramsey\Uuid\Uuid::uuid4();
            }
        });
    }

}
