<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            // Relaciona os campos entre o Resource e o Model
            ID::make(__('ID'), 'id')->sortable()->hideFromIndex(),
            Text::make("Name")->sortable(),
            // hideFromIndex esconde da listagem principal.
            Textarea::make("Description")->hideFromIndex(),

            // TODO: Campo Currency esta jogando exception. Workaround está sendo usar Number.
            // message: The Symfony\Component\Intl\NumberFormatter\NumberFormatter::setAttribute() method's argument $attr value 2 behavior is not implemented. The available attributes are: FRACTION_DIGITS, GROUPING_USED, ROUNDING_MODE.  Please install the "intl" extension for full localization capabilities.
//            Currency::make("Price")->nullable(),
            Number::make("Price")->sortable(),


            Number::make("Qtd Available", "qtd_available")->sortable(),
            Number::make("Qtd Total", "qtd_total")->sortable(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
