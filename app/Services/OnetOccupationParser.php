<?php

namespace App\Services;

use App\Contracts\OccupationParser;

class OnetOccupationParser implements OccupationParser
{
    private string $scope = '';

    public function setScope($scope): OccupationParser
    {
        $this->scope = $scope;
        return $this;
    }

    public function getScope(): string
    {
        return ucfirst(str_plural(strtolower($this->scope)));
    }

    public function getUrl($occupation_code): string
    {
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

    public function get($occupation_code): array
    {
        $data = file_get_contents($this->getUrl($occupation_code));

        $rows = explode("\n",$data);

        $s = array();

        foreach($rows as $i => $row) {
            $values = str_getcsv($row);

            if ($i > 0 && count($values) === 3) {
                $s[] = $values;
            }
        }

        return $s;
    }

    public function compare(string $occupation1, string $occupation2): array
    {
        $occupation_1 = $this->get($occupation1);

        $occupation_2 = $this->get($occupation2);

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