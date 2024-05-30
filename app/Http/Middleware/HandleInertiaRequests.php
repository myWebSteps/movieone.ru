<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Jenssegers\Agent\Agent;


class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $agent = new Agent();

        $showMenu = false;
        $coverImg = "/img/cover.webp";

        if ($agent->isMobile())
        {
            $showMenu = true;
            $coverImg = "/img/cover_min.webp";
        };


        return array_merge(parent::share($request), [
            'auth' => ['user' => $request->user()],
            'categories' => \Illuminate\Support\Facades\Cache::get('categories'),
            'showMenu' => $showMenu,
            'coverImg' => $coverImg,
        ]);
    }
}
