<?php

namespace App\Http\Controllers\Back\Admin\Countries;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Admin\Countries\UpdateRequest;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Country $country)
    {
       $data = $request->validated();
       $country->update($data);
       return to_route('countries.index');
    }
}
