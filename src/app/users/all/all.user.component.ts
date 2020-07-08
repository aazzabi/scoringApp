import {Component, OnInit} from '@angular/core';
import {Location} from '@angular/common';
import {ActivatedRoute, Router} from '@angular/router';
import {ContribuableService} from '../../services/manager/ContribuableService';
import {UsersService} from '../../services/manager/UserService';
import {EditContribuableComponent} from '../../contribuable/edit/edit.contribuable.component';
import {BsModalService} from 'ngx-bootstrap/modal';
import {NgbModal} from '@ng-bootstrap/ng-bootstrap';
import {EditUserComponent} from '../edit/edit.user.component';

@Component({
  // tslint:disable-next-line:component-selector
  selector: 'all-user-root',
  templateUrl: './all.user.component.html',
})
export class AllUserComponent implements OnInit  {
  users: any[];
  dtOptions: DataTables.Settings = {};

  constructor(
    private modalService: NgbModal,
    private userServices: UsersService,
    private route: ActivatedRoute,
    private router: Router,
  ) {
    this.users = this.route.snapshot.data.users;
  }

  ngOnInit() {
    // this.userServices.getCalcule('999').subscribe((response) => console.log(response, '******'));
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



  openEdit(contrib) {
    const modalRef = this.modalService.open(EditUserComponent);
    modalRef.componentInstance.userToEdit = contrib;
  }


  delete(c: any, i: any) {
    if (confirm('Vous allez supprimer ce user ! \n etes-vous sure ?')) {
      this.userServices.delete(c).subscribe(
        response => {
          this.users.splice(i, 1);
        },
        error => {
          console.log(error);
        }
      );
    }
  }
}
