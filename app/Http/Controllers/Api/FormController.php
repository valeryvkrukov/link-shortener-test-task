<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShortenRequest;
use App\Http\Resources\ShortenerResource;
use App\Models\ShortenedLink;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class FormController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param ShortenRequest $request
     * @return ShortenerResource|Response
     */
    public function store(ShortenRequest $request)
    {
        try {
            $data = $request->validated();
            $data['shortened_link'] = substr(md5(Hash::make($data['original_url'])), 10, 20);

            $shortenedLink = ShortenedLink::create($data);
        } catch (\Exception $exception) {
            return response(['error.message' => $exception->getMessage()]);
        }

        return new ShortenerResource($shortenedLink);
    }

}
