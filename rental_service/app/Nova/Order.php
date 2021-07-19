<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Order extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Order::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make("Customer")->searchable(),
            Select::make("Status")->options([
               'Reservado'=>'Reservado',
               'Aguardando Retirada'=>'Aguardando Retirada',
               'Entregue'=>'Entregue',
               'Concluido'=>'Concluido'
            ]),
            Number::make("Downpayment")->hideFromIndex(), // Esconde da listagem
            Number::make("Delivery fee", 'delivery_fee')->hideFromIndex(), // Esconde da listagem
            Number::make("Late fee", 'late_fee')->hideFromIndex(), // Esconde da listagem
            Number::make("Discount")->hideFromIndex(),
            Date::make("Reservation date", "order_date"),
            Date::make("Return date", "return_date"),
            Number::make("Total")->readonly(), // Calculado automaticamente
            Number::make("Balance")->readonly(), // Calculado automaticamente
            HasMany::make("Items", "items", "App\Nova\OrderItem"),
            // Não precisa repetir tudo pois o nome da entidade é o mesmo
            HasMany::make("Payments")->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
