<?php
/**
 * Erzeugt tr aus Array
 *
 * @param [array] $daten
 * @param [string] $tr
 * @return string
 */
    function makeTab($daten, $tr){ // tr = platzhalter, wird bei benutzen der funktion ersetzt z.B durch "|"
        $tab1="";
        //print_r( $daten);
        for ($z=0; $z <count($daten) ; $z++) { 
            $tab1.="\t\t<tr>";
            //zeilenumbruch entfernen
            $daten[$z]=trim($daten[$z]);
            // auseinanderschneiden bei ;
            $a=explode($tr,$daten[$z]);
            foreach ($a as $key => $value) {
                $tab1.= "\n\t\t\t<td>".$value.'</td>';
            }
            $tab1.="</tr>\n";

                // Generiere <hr> nach jedem Tabellenelement außer dem letzten
            // if ($z < count($daten) - 1) {
            //     $tab1 .= "<tr><td colspan='" . count($a) . "'><hr></td></tr>\n";
            // };
        };
        return $tab1;
    };



