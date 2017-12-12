<?php

namespace App\Sensanoma\Transformer;


class ConsoleTvChartTransformer implements TransformerInterface
{
    public function transform($datas)
    {
        if(isset($datas['error'])) {
            return $datas['error'];
        }
        $values = [];
        $labels = [];

        foreach ($datas as $serie) {

            foreach ($serie['values'] as $value) {
                array_push($labels, \Carbon\Carbon::parse($value[0])->toDateString());
                array_push($values, intval($value[1], 0));
            }

        }

        return [
            'labels' => $labels,
            'values' => $values
        ];
    }

}