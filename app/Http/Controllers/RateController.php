<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RatePostRequest;

class RateController extends Controller
{
    /**
     * Handles the rating submission for a specific song.
     * If the user has already rated the song, it updates the rating. Otherwise, it creates a new rating.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing the rating value
     * @param  int  $id  The ID of the song being rated
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(RatePostRequest $request, $id)
    {
        $ratingValue = $request->post("rate");

        $rating = Rating::where('user_id', Auth::id())
            ->where('song_id', $id)
            ->first();

        if ($rating) {
            if ($rating->rate != $ratingValue) {
                $rating->update(['rate' => $ratingValue]);
            }
        } else {
            Rating::create([
                'user_id' => Auth::id(),
                'song_id' => $id,
                'rate' => $ratingValue,
            ]);
        }

        $averageRate = Rating::where('song_id', $id)->avg('rate');

        return redirect()->back();
    }
}
