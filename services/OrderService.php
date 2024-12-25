<?php

namespace app\services;

class OrderService {

    public function createRandom($characters) {
        $random = '';
        for ($i = 0; $i < 10; $i++) {
            $random .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $random;
    }

}