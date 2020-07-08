import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {CreancesService} from '../../services/manager/CreancesService';
import * as XLSX from 'xlsx';

declare interface TableData {
  headerRow: string[];
  dataRows: string[][];
}

// @ts-ignore
@Component({
  // tslint:disable-next-line:component-selector
  selector: 'all-creances-root',
  templateUrl: './all.creances.component.html',
})
export class AllCreancesComponent implements OnInit {
  public tableData1: TableData;
  public tableData2: TableData;
  fileName = 'creances.xlsx';

  creances = [];
  allCreances = [];
  dtOptions: DataTables.Settings = {};

  constructor(
    private route: ActivatedRoute,
    private creancesService: CreancesService,
    private router: Router,
  ) {
    this.creances = this.route.snapshot.data.creances;
    console.log(this.creances, 'creances');
    this.creances.forEach((c) => {
      this.creancesService.getScore(c.id).subscribe((data) => {
        c.score = data;
      });
    });
    console.log(this.creances, 'creances');
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

  delete(c: any, i: number) {
    if (confirm('Vous allez supprimer ce contribuable ! \n etes-vous sure ?')) {
      this.creancesService.delete(c).subscribe(
        response => {
          this.creances.splice(i, 1);
        },
        error => {
          console.log(error);
        }
      );
    }
  }

  exportexcel() {
    /* table id is passed over here */
    const element = document.getElementById('creances-table');
    const ws: XLSX.WorkSheet = XLSX.utils.table_to_sheet(element);

    /* generate workbook and add the worksheet */
    const wb: XLSX.WorkBook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

    /* save to file */
    XLSX.writeFile(wb, this.fileName);
  }
}
