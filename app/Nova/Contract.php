<?php

namespace App\Nova;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Date;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class Contract extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Contract>
     */
    public static $model = \App\Models\Contract::class;

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
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Mã hợp đồng', 'contract_id')
                ->resolveUsing(function () {
                    // Thực hiện logic để lấy giá trị từ MySQL
                    $contractId = Contract::latest()->value('contract_id');
                    // Trả về giá trị để hiển thị trong Nova
                    return $contractId;
                })
            ->onlyOnDetail(),

            Text::make('Họ và tên', 'name')
                ->sortable()
                ->rules(['required']),

            Number::make('Năm sinh', 'year')
                ->rules(['nullable'])
                ->min(1900)
                ->max(2099)
                ->step(1)
                ->sortable()
                ->hideFromIndex(),

            Text::make('Căn cước công dân', 'id_card')
                ->sortable()
                ->rules(['required']),

            Text::make('Địa chỉ', 'address')
                ->sortable()
                ->rules(['nullable'])
                ->hideFromIndex(),

            Text::make('Số điện thoại', 'mobile')
                ->sortable()
                ->rules(['nullable'])
                ->hideFromIndex(),

            Text::make('Mã bất động sản', 'property_id')
                ->onlyOnDetail(),

            Date::make('Ngày lập hợp đồng', 'day')
                ->sortable()
                ->rules(['required', 'date_format:Y-m-d', 'before:today']),

            Text::make('Giá trị hợp đồng', 'price')
                ->sortable()
                ->rules(['required'])
                ->updateRules(['required']),

            Text::make('Số tiền đã cọc', 'deposit')
                ->sortable()
                ->rules(['required'])
                ->updateRules(['required'])
                ->hideWhenCreating(),
                
            Text::make('Số tiền còn lại', 'remain')
                ->sortable()
                ->updateRules(['required'])
                ->hideWhenCreating(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    public function title()
    {
        return 'Hợp đồng đầy đủ';
    }
    
}
