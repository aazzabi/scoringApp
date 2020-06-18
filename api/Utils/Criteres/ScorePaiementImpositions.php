<?php
//paiement des impositions
/*si Nombre d'échéances d'un plan de règlement non respectée >1 score=0 
*sinon si Nombre de paiements par chèque sans provision>1 score=0 
*sinon si Paiements effectués au plus tard à la date d'exigibilité>50% score=0
*sinon si 50%<Paiements effectués au plus tard à la date d'exigibilité<75% score=1 
*sinon si 75%<Paiements effectués au plus tard à la date d'exigibilité<90% score=2
*sinon (Paiements effectués au plus tard à la date d'exigibilité> 90%) score=3 */