import {Component, OnInit} from '@angular/core';
import {Location} from '@angular/common';
import {ActivatedRoute, Router} from '@angular/router';
import {ContribuableService} from '../../services/manager/ContribuableService';
import {UsersService} from '../../services/manager/UserService';
import {EditContribuableComponent} from '../../contribuable/edit/edit.contribuable.component';
import {BsModalService} from 'ngx-bootstrap/modal';
import {NgbModal} from '@ng-bootstrap/ng-bootstrap';
import {CriteresService} from '../../services/manager/CriteresService';
import {StorageService} from '../../services/security/storage.service';

@Component({
  // tslint:disable-next-line:component-selector
  selector: 'all-critere-root',
  templateUrl: './all.critere.component.html',
})
export class AllCritereComponent implements OnInit  {
  criteres: any[];
  dtOptions: DataTables.Settings = {};
  loggedUser : any;
  constructor(
    private modalService: NgbModal,
    private critereServices: CriteresService,
    private route: ActivatedRoute,
    private router: Router,
  ) {
    this.criteres = this.route.snapshot.data.criteres;
    this.loggedUser = StorageService.decodeToken().data;
  }

  ngOnInit() {
    // this.critereServices.getCalcule('999').subscribe((response) => console.log(response, '******'));

    this.dtOptions = {
      pagingType: 'full_numbers',
      pageLength: 5,
      processing: true,
      language: {
        emptyTable : 'Aucune donnée disponible dans le tableau',
        info: 'Affichage de l\'élément _START_ à _END_ sur _TOTAL_ éléments',
        infoEmpty: 'Affichage de l\'élément 0 à 0 sur 0 élément',
        infoFiltered: '(filtré à partir de _MAX_ éléments au total)',
        infoPostFix: '',
        lengthMenu: 'Afficher _MENU_ éléments',
        loadingRecords: 'Chargement...',
        processing: 'Traitement...',
        search: 'Rechercher :',
        zeroRecords: 'Aucun élément correspondant trouvé',
        paginate: {
          first: 'Premier',
          last: 'Dernier',
          next: 'Suivant',
          previous: 'Précédent'
        },
        aria: {
          sortAscending: ': activer pour trier la colonne par ordre croissant',
          sortDescending: ': activer pour trier la colonne par ordre décroissant'
        },
      }
    };
  }

  delete(c: any, i: any) {
    if (confirm('Vous allez supprimer ce critere ! \n etes-vous sure ?')) {
      this.critereServices.delete(c).subscribe(
        response => {
          this.criteres.splice(i, 1);
        },
        error => {
          console.log(error);
        }
      );
    }
  }

  activateCritere(id: any, i : any) {
    this.critereServices.activate(id).subscribe((data) => {
      this.criteres[i].isActive = true;
    }, error => {
      this.criteres[i].isActive = true;
    });
  }
  desactivateCritere(id: any, i : any) {
    this.critereServices.desactivate(id).subscribe((data) => {
      this.criteres[i].isActive = false;
    }, error => {
      this.criteres[i].isActive = false;
    });

  }
}
