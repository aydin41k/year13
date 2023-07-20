<?php

namespace App\Services;

use App\Contracts\OccupationParser;
use Illuminate\Support\Facades\Log;

class OnetOccupationParser implements OccupationParser
{
    private string $scope = '';
    private int $proximity_threshold = 10;

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
        $occupation_1_skill_values = $this->getOccupationSkillValues($occupation_1);

        $occupation_2 = $this->get($occupation2);
        $occupation_2_skill_values = $this->getOccupationSkillValues($occupation_2);

        $match = $this->getMatch($occupation_1_skill_values, $occupation_2_skill_values);

        return [
            'occupation_1' => $occupation_1_skill_values,
            'occupation_2' => $occupation_2_skill_values,
            'match' => $match
        ];
    }

    /**
     * Convert each skill to an array with the skill as the key and importance as the value
     * to make the matching easier
     *
     * @param array $occupation
     * @return array
     */
    private function getOccupationSkillValues(array $occupation): array
    {
        $result = [];

        foreach($occupation as $skill) {
            $result[$skill[1]] = $skill[0];
        }

        return $result;
    }

    /**
     * Algorithm to match skills of two occupations.
     * The logic is to count the number of skills that are
     * within $proximity_threshold units of importance of each other.
     * I.e., count of the skills that carry similar importance for both occupations.
     *
     * @param array $set_1
     * @param array $set_2
     * @return int
     */
    private function getMatch(array $set_1, array $set_2): int
    {
        $allSkillsCount = max(count($set_1), count($set_2));

        if (!$allSkillsCount) {
            return 0;
        }

        // Easiest way is to loop and count;
        // array_reduce() gets too complicated and beats the purpose
        $matchingSkills = [];

        foreach ($set_1 as $skill => $importance) {
            if (isset($set_2[$skill]) && abs($importance - $set_2[$skill]) <= $this->proximity_threshold) {
                $matchingSkills[$skill] = [$importance, $set_2[$skill]];
            }
        }

        $match = count($matchingSkills) / $allSkillsCount;

        Log::info('OnetOccupationParser::getMatch()', [
            'matching_skills' => $matchingSkills,
            'match' => $match
        ]);

        return round($match * 100);
    }
}