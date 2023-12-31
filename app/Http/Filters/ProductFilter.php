<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\AbstractFilter;
use Illuminate\Support\Facades\DB;
use App\Models\OptionValue;


class ProductFilter extends AbstractFilter
{
    public const BRAND_ID = 'brandsId';
    public const CATEGORY_ID = 'categoryId';
    public const MIN_PRICE = 'minPrice';
    public const MAX_PRICE = 'maxPrice';
    public const SORT = 'sort';
    public const TITLE = 'title';
    public const OPTIONS = 'options';







    protected function getCallbacks(): array
    {

        return [
            static::BRAND_ID => [$this, 'brandsId'],
            static::CATEGORY_ID => [$this, 'categoryId'],
            static::MIN_PRICE => [$this, 'minPrice'],
            static::MAX_PRICE => [$this, 'maxPrice'],
            static::SORT => [$this, 'sort'],
            static::TITLE => [$this, 'title'],
            static::OPTIONS => [$this, 'options'],

        ];
    }

    public function sort(Builder $builder, string $value): void
    {

        if ($value === 'default') {
            $builder->orderBy('count_estimates', 'desc');
        }

        if ($value === 'title') {
            $builder->orderBy('title');
        }

        if ($value === 'cheap') {
            $builder->orderBy('price');
        }

        if ($value === 'expensive') {
            $builder->orderBy('price', 'desc');
        }
    }

    public function options(Builder $builder, array $values): void
    {
        $productIds = OptionValue::whereIn('value', $values)
            ->with('products:id')  // Загружаем связанные продукты, оставляем только ID
            ->get()
            ->pluck('products')
            ->collapse()
            ->pluck('id')
            ->all();

        $builder->whereIn('id', $productIds);
    }

    public function title(Builder $builder, string $value): void
    {
        $value = strtolower($value);
        $builder->where('title', 'like', "%$value%");
    }

    public function minPrice(Builder $builder,  $minPrice): void
    {
        $builder->where('price', '>=', $minPrice);
    }

    public function maxPrice(Builder $builder,  $maxPrice): void
    {
        $builder->where('price', '<=', $maxPrice);
    }

    public function brandsId(Builder $builder, $value)
    {
        $builder->whereIn('brand_id', $value);
    }

    public function categoryId(Builder $builder, $value)
    {
        $res = DB::table('category_product')
            ->where('category_id', $value)
            ->get('product_id');

        foreach ($res as $item) {
            $arr[] = $item->product_id;
        }

        $builder->whereIn('id', $arr);
    }
}