<?php

declare(strict_types=1);

it('ensures home page is available', function () {
    $this->get('/')->assertSuccessful();
});
