<?php
/* Esta sera la clase principal para el filtro */
namespace App\Filters;
use Illuminate\Http\Request;
class ApiFilter{
    /* Esto es para filtrar dentro de la url de la api */
    protected $safeParams = []; /* parametros para filtrar -> name, tipo, etc*/
    protected $columnMap = []; /* mapeo de columnas de como se van a filtrar */
    protected $operatorMap = []; /* mapeo de operadores */

    /* transformar la query recibida para filtrar */
    public function transform(Request $request){
       $eloQuery = [];
       foreach($this->safeParams as $parm =>$operators){
        $query = $request->query($parm);
        if(!isset($query)){
            continue;
        }
        $column = $this->columnMap[$parm] ?? $parm;
        foreach($operators as $operator){
            if(isset($query[$operator])){
                $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];  
            }
        }
       }
       return $eloQuery;
    }
}