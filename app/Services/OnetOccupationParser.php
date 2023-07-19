<?php

namespace App\Services;

use App\Contracts\OccupationParser;
use Illuminate\Support\Facades\Log;

class OnetOccupationParser implements OccupationParser
{
    private string $scope = '';
    private int $relevance_threshold = 50;

    public function setScope(string $scope): OccupationParser
    {
        $this->scope = $scope;
        return $this;
    }

    public function getScope(): string
    {
        return ucfirst(str_plural(strtolower($this->scope)));
    }

    public function getUrl(string $occupation_code): string
    {
        Log::info('OnetOccupationParser::getUrl()', [
            'occupation_code' => $occupation_code,
            'scope' => $this->getScope()
        ]);

        return 'https://www.onetonline.org/link/table/details/'
            .substr($this->scope, 0, 2)
            .'/'
            .$occupation_code
            .'/'
            .$this->getScope()
            .'_'
            .$occupation_code
            .'.csv?fmt=csv';
    }

    public function list(): array
    {
        $json = file_get_contents(storage_path('/app/onet_occupations.json'));

        return json_decode($json, true);
    }

    public function get(string $occupation_code): array
    {
        $data = file_get_contents($this->getUrl($occupation_code));

        $rows = explode("\n",$data);

        $s = array();

        foreach($rows as $i => $row) {
            $values = str_getcsv($row);

            if ($i > 0 && count($values) === 3) {
                // Converting the importance value to an integer
                $s[] = [(int) $values[0], $values[1], $values[2]];
            }
        }

        Log::info('OnetOccupationParser::get()', [
            'count' => count($s),
            'occupation_code' => $occupation_code,
            'scope' => $this->getScope()
        ]);

        return $s;
    }

    public function compare(string $occupation1, string $occupation2): array
    {
        Log::info('OnetOccupationParser::compare()', [
            $occupation1, $occupation2, $this->scope
        ]);

        $occupation_1 = $this->get($occupation1);
        $occupation_1_relevant_skills = $this->getRelevantSkills($occupation_1);

        $occupation_2 = $this->get($occupation2);
        $occupation_2_relevant_skills = $this->getRelevantSkills($occupation_2);

        $match = $this->getMatch($occupation_1_relevant_skills, $occupation_2_relevant_skills);

        return [
            'occupation_1' => $occupation_1,
            'occupation_2' => $occupation_2,
            'match' => $match
        ];
    }

    private function getRelevantSkills(array $occupation): array
    {
        if (!$occupation) {
            return [];
        }

        return array_filter($occupation, function($attribs) {
            return (int) $attribs[0] >= $this->relevance_threshold;
        });
    }

    private function getMatch(array $set_1, array $set_2): int
    {
        $matchingSkills = array_intersect(
            array_column($set_1, 1),
            array_column($set_2, 1)
        );

        $allSkills = array_unique(array_merge(
            array_column($set_1, 1),
            array_column($set_2, 1)
        ));

        $match = count($matchingSkills) / count($allSkills);

        Log::info('OnetOccupationParser::getMatch()', [
            'matching_skills' => $matchingSkills,
            'all_skills' => $allSkills,
            'match' => $match
        ]);

        return round($match * 100);
    }
}