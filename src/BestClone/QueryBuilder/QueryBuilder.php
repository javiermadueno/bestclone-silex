<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 16:36
 */

namespace BestClone\QueryBuilder;



class QueryBuilder
{

    public function generate(array $param, $tabla)
    {
        $query =
            "select Todos.ID as ID,
            convert(varchar(9), '') as Codigo,
            convert(varchar(20), IsNull({$tabla}.Nombre, '')) as Nombre,
            convert(varchar(25), IsNull({$tabla}.Apellido1, '')) AS Apellido1,
            convert(varchar(25), IsNull({$tabla}.Apellido2, '')) AS Apellido2,
            convert(varchar(5), IsNull({$tabla}.TipoVia, '')) AS TipoVia,
            convert(varchar(50), IsNull({$tabla}.Via, '')) AS Via,
            convert(varchar(50), IsNull({$tabla}.Pseudovia, '')) as Pseudovia,
            convert(varchar(4), convert(int, IsNull({$tabla}.NumeroVia, '0'))) AS NumeroVia,
            convert(varchar(1), IsNull({$tabla}.CodDomicilio, '')) as ComplementoNum,
            convert(varchar(10), IsNull({$tabla}.Bloque, '')) as Bloque,
            convert(varchar(10), IsNull({$tabla}.Portal, '')) as Portal,
            convert(varchar(10), IsNull({$tabla}.Escalera, '')) as Escalera,
            convert(varchar(10), IsNull({$tabla}.Piso, '')) as Piso,
            convert(varchar(10), IsNull({$tabla}.Puerta, '')) as Puerta,
            convert(varchar(3), IsNull({$tabla}.KM, '')) as KM,
            convert(varchar(1), IsNull({$tabla}.HM, '')) as HM,
            convert(varchar(5), IsNull({$tabla}.CP, '')) as CP,
            convert(varchar(50), IsNull({$tabla}.Municipio, '')) as Municipio,
            convert(varchar(80), IsNull({$tabla}.Submunicipio, '')) as Submunicipio,
            convert(varchar(25), IsNull({$tabla}.Provincia, '')) as Provincia,
            convert(varchar(11), IsNull({$tabla}.CodIne, '')) as CodIne,
            convert(varchar(5), IsNull({$tabla}.CodVia, '')) as CodVia,
            convert(varchar(1), IsNull({$tabla}.Sexo, '')) as Sexo,
            case when {$tabla}.MismoDom = 1 then convert(varchar(9), IsNull({$tabla}.Telefono, '')) else space(9) end as Telefono,
            case when {$tabla}.MismoDom = 1 then convert(varchar(1), IsNull({$tabla}.TitTelefono, '')) else space(1) end as TitTelefono,
            convert(varchar(9), '') as NIF,
            convert(varchar(1), IsNull(substring({$tabla}.Anno,4,1), '')) + convert(varchar(1), IsNull(substring({$tabla}.Anno,3,1), '')) as A";

    }


} 