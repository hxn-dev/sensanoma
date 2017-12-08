<?php

namespace App\Sensanoma\Transformer;


class ConsoleTvChartTransformer
{
    public function transform($datas, $chart)
    {
        if(isset($datas['error'])) {
            return $datas['error'];
        }

        foreach ($datas as $serie) {
            $values = [];
            $labels = [];
            foreach ($serie['values'] as $value) {
                array_push($labels, \Carbon\Carbon::parse($value[0])->toDateString());
                array_push($values, intval($value[1], 0));
            }
            $chart->labels($labels);
            $chart->dataset($serie['name'], $values);
        }

        return $chart;
    }

}