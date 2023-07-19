<?php

namespace App\Contracts;

interface OccupationParser
{
    function setScope(string $scope): OccupationParser;
    function getScope(): string;
    function getUrl(string $occupation_code): string;
    function list(): array;
    function get(string $occupation_code): array;
}