<?php
/*
// statique
if ($chiffre > 10000) {
    echo 3;
} else {
    echo 1;
}
*/
/*
 * Sans choix
 *
 * critére 3andou une valeur COEFFICIENT
 *
 *

if ($chiffre > 10000) {
    echo 3 * $critere['coeff'];
} else {
    echo 1 * $critere['coeff'];
}
*/

/*
 * On a la liste des choix
 * Critere('libelle', coef, pondere, note);
 *
 * Liste de choix mel BD :
 *  choix1 = > 3, 3
 *  choix2 = > 1, 1
 *  choix3 = > 0, 0

if ($chiffre < 10000) {
    echo $choix1['pondere'] * $choix1['coeff'];
} else {
    echo $choix2['pondere'] * $choix2['coeff'];
}
 */
