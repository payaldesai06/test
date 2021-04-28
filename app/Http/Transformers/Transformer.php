<?php

namespace App\Http\Transformers;

abstract class Transformer 
{
    public function nulltoBlank($data)
    {
        return $data ? $data : '';
    }
}
