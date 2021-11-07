<?php

namespace App\Http\Controllers;

use App\Models\ShortenedLink;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class MainController extends Controller
{
    public function index()
    {
        return view('main');
    }

    /**
     * Redirect to original URL or return error message to frontend part
     *
     * @param Request $request
     * @param string $requestLink
     * @return Response|RedirectResponse
     */
    public function redirectTo(Request $request, string $requestLink)
    {
        try {
            $shortenedLink = ShortenedLink::where('shortened_link', '=', $requestLink)->firstOrFail();
            $originalUrl = $shortenedLink->original_url;
        } catch (\Exception $exception) {
            if ($exception->getCode() === 0) {
                return response(['error.message' => 'Link does not exists']);
            } else {
                return response(['error.message' => $exception->getMessage()]);
            }
        }

        return redirect($originalUrl);
    }
}
