<?php

namespace App\Services;

use App\Contracts\OccupationParser;

class OnetOccupationService
{
    private $parser;
    private $defaultScope = 'skills';

    public function __construct(OccupationParser $parser)
    {
        $this->parser = $parser;
    }

    // List function
    public function list(string $scope = 'skills'): array
    {
        return $this->parser->setScope($scope)->list();
    }

    public function compare(
        string $occupation1,
        string $occupation2,
        string $scope
    ): array
    {
        $parserScope = ($scope) ?: $this->defaultScope;

        $this->parser->setScope($parserScope);
        $occupation_1 = $this->parser->get($occupation1);
        $occupation_2 = $this->parser->get($occupation2);

        /** IMPLEMENT COMPARISON **/
        $match = 66;
        /** IMPLEMENT COMPARISON **/

        return [
            'occupation_1' => $occupation_1,
            'occupation_2' => $occupation_2,
            'match' => $match
        ];
    }
}