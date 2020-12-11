<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\Game;
use Illuminate\Http\JsonResponse;

class TestController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @param Game $game
     * @return JsonResponse
     */
    public function index(Game $game) {
        return response()->json([
            'dates' => $game->getRangeOfDates(),
            'weekends' => $game->getTheWeekends(),
            'clearList' => $game->getDatesWithoutWeekends(),
            'valuesAssigned' => $game->getValuesPerDay(),
            'checkAboveOrBelow1P' => $game->checkAboveOrBelow1P(),
            'result' => $game->finalTouch(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Game $game
     * @return JsonResponse
     */
    public function dates(Game $game) {
        return response()->json([
            'dates' => $game->getRangeOfDates()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Game $game
     * @return JsonResponse
     */
    public function weekends(Game $game) {
        return response()->json([
            'weekends' => $game->getTheWeekends(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Game $game
     * @return JsonResponse
     */
    public function clearList(Game $game) {
        return response()->json([
            'clearList' => $game->getDatesWithoutWeekends(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Game $game
     * @return JsonResponse
     */
    public function valuesAssigned(Game $game) {
        return response()->json([
            'valuesAssigned' => $game->getValuesPerDay()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Game $game
     * @return JsonResponse
     */
    public function checkAboveOrBelow1P(Game $game) {
        return response()->json([
            'checkAboveOrBelow1P' => $game->checkAboveOrBelow1P(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Game $game
     * @return JsonResponse
     */
    public function finalTouch(Game $game) {
        return response()->json([
            'result' => $game->finalTouch(),
        ]);
    }

}
