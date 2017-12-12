<?php

namespace App\Sensanoma\Transformer;


class LastAverageResultTransformer implements TransformerInterface
{
    public function transform($datas)
    {
        if(isset($datas['error'])) {
            return $datas['error'];
        }

        $data = '';

        foreach ($datas as $serie) {

            foreach ($serie['values'] as $value) {
                $data = $value[1];
            }

        }

        return number_format($data, 1);
    }

}