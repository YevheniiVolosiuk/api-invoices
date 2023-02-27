<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class ApiFilter
{
    protected array $allowedParms = [];

    protected array $columnMap = [];

    protected array $operatorMap = [];

    public function transform(Request $request): array
    {
        $eloQuery = [];

        foreach ($this->allowedParms as $parm => $operators){
            $query = $request->query($parm);

            if(!isset($query)){
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator){
                if(isset($query[$operator])){
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }

        }

        return $eloQuery;
    }
}
