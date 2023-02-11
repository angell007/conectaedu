<?php

namespace App\Traits;

use Illuminate\Http\Response as Respon;

trait Qr
{
    public function generateQr($dato, $folder)
    {

        \QrCode::backgroundColor(255, 255, 0)->color(255, 0, 127)
            ->format('png')
            // ->merge(public_path('/imgs/inventory.png'), 0.3, true)
            ->size(300)
            ->generate($dato,  public_path("/imgs/{$folder}/" . strval($dato) . '.png'));

        return $dato;
    }
}
