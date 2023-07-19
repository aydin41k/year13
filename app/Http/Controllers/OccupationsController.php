<?php

namespace App\Http\Controllers;

use App\Services\OnetOccupationService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class OccupationsController extends BaseController
{
    private $occService;

    public function __construct(OnetOccupationService $occService)
    {
        $this->occService = $occService;
    }
    public function list()
    {
        return $this->occService->list();
    }

    public function compare(Request $request)
    {
        $validated = $request->validate([
            'occupation_1' => 'required|string',
            'occupation_2' => 'required|string',
            'scope' => 'string',
        ]);

        $scope = $validated['scope'] ?? '';

        return $this->occService->compare(
            $validated['occupation_1'],
            $validated['occupation_2'],
            $scope,
        );
    }
}