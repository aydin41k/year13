<?php

namespace App\Http\Controllers;

use App\Services\OnetOccupationParser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class OccupationsController extends BaseController
{
    private $occParser;

    public function __construct(OnetOccupationParser $occParser)
    {
        $this->occParser = $occParser;
    }
    public function list()
    {
        return $this->occParser->list();
    }

    public function compare(Request $request)
    {
        $validated = $request->validate([
            'occupation_1' => 'required|string',
            'occupation_2' => 'required|string',
            'scope' => 'string',
        ]);

        $scope = $validated['scope'] ?? 'skills';

        return $this->occParser->setScope($scope)->compare(
            $validated['occupation_1'],
            $validated['occupation_2']
        );
    }
}