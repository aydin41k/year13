<?php

namespace App\Http\Controllers;

use App\Services\OnetOccupationParser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class OccupationsController extends BaseController
{
    private OnetOccupationParser $occParser;

    public function __construct(OnetOccupationParser $occParser)
    {
        $this->occParser = $occParser;
    }
    public function list(): array
    {
        return $this->occParser->list();
    }

    public function compare(Request $request): array
    {
        $validated = $request->validate([
            'occupation_1' => 'required|string',
            'occupation_2' => 'required|string',
            'scope' => 'string',
        ]);

        $scope = $validated['scope'] ?? 'skills';

        Log::info('OccupationsController::compare()', [
            'occupation_1' => $validated['occupation_1'],
            'occupation_2' => $validated['occupation_2'],
            'scope' => $scope
        ]);

        return $this->occParser->setScope($scope)->compare(
            $validated['occupation_1'],
            $validated['occupation_2']
        );
    }
}