import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {ContribuableService} from '../../services/manager/ContribuableService';
import {NgbModal} from '@ng-bootstrap/ng-bootstrap';
import {EditContribuableComponent} from '../edit/edit.contribuable.component';

declare interface TableData {
  headerRow: string[];
  dataRows: string[][];
}

// @ts-ignore
@Component({
  // tslint:disable-next-line:component-selector
  selector: 'all-contribuable-root',
  templateUrl: './all.contribuable.component.html',
})
export class AllContribuableComponent implements OnInit {
  public tableData1: TableData;
  public tableData2: TableData;

  contribuables = [];
  dtOptions: DataTables.Settings = {};

  constructor(
    private route: ActivatedRoute,
    private contribuableService: ContribuableService,
    private router: Router,
    private modalService: NgbModal
  ) {
    this.router.navigate(['/contribuable']);
    this.contribuables = this.route.snapshot.data.contribuables;
    console.log(this.contribuables);
  }

  ngOnInit() {
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

  edit(contrib) {
    const modalRef = this.modalService.open(EditContribuableComponent);
    modalRef.componentInstance.contribuableToEdit = contrib;
  }

  delete(c: any, i: number) {
    if (confirm('Vous allez supprimer ce contribuable ! \n etes-vous sure ?')) {
      this.contribuableService.delete(c).subscribe(
        response => {
          this.contribuables.splice(i, 1);
        },
        error => {
          console.log(error);
        }
      );
    }
  }
}
