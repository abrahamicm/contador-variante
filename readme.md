## Nombre
`[corefix_contador]`

## Descripción
El shortcode `[corefix_contador]` muestra un contador que se actualiza automáticamente con un valor inicial, un valor final y un periodo de actualización definidos por el usuario. El contador se actualiza a través de JavaScript, y el shortcode solo define los parámetros iniciales para el contador.

~~~
[corefix_contador startdate="FECHA_INICIAL" enddate="FECHA_FINAL" startvalue="VALOR_INICIAL" endvalue="VALOR_FINAL" periodday="PERIODO_DIA" periodnight="PERIODO_NOCTURNO"]
~~~

Los parámetros obligatorios son startDate, enddate, startvalue, endvalue, periodday y periodnight. Los parámetros son los siguientes:

- startDate (obligatorio): La fecha y hora de inicio del contador en formato javascript.
- enddate (obligatorio): La fecha y hora de finalización del contador en formato javascript.
- startvalue (obligatorio): El valor inicial del contador.
- endvalue (obligatorio): El valor final del contador.
- periodday (obligatorio): El periodo de actualización del contador durante el día en segundos.
- periodnight (obligatorio): El periodo de actualización del contador durante la noche en segundos.

## Caracteristicas 

- cuando el tiempo actual es menor startdate, el valor que retona el shorcode es startvalue.
- cuando el tiempo actual es mayor a enddate, el valor que retona el shorcode es endvalue.
- separador de mil es ','
- periodday y periodnight representa el peridoso en segundos, ejemplo si se quiere establece que el periodo diurno sea un segundo `periodday=1`, si queremos que el periodo nocturno sea medio segundo `periodnight=0.5`


## ejemplo de uso
~~~
[corefix_contador startdate="2023-02-10" enddate="2023-02-25" startvalue="0" endvalue="20000" periodday="2" periodnight="0.5"]
~~~