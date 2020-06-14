import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {NgbModal} from '@ng-bootstrap/ng-bootstrap';
import {CreancesService} from '../../services/manager/CreancesService';

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

  creances = [];
  allCreances = [];
  dtOptions: DataTables.Settings = {};

  constructor(
    private route: ActivatedRoute,
    private creancesService: CreancesService,
    private router: Router,
  ) {
    this.creances = this.route.snapshot.data.creances;
    this.creances.forEach((c) => {
      this.creancesService.getScore(c.id).subscribe((data)=> {
        c.score = data;
      });
    })
    console.log(this.creances, 'creances');
  }

  ngOnInit() {
    this.dtOptions = {
      pagingType: 'full_numbers',
      pageLength: 5,
      processing: true
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
}
