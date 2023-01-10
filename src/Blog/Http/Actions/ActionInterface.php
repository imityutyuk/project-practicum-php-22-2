<?php

namespace Tgu\Mityutyuk\Blog\Http\Actions;

use Tgu\Mityutyuk\Blog\Http\Request;
use Tgu\Mityutyuk\Blog\Http\Response;

interface ActionInterface
{
    public function handle(Request $request):Response;
}