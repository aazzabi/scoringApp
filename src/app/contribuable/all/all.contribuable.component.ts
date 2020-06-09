import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Route, Router} from '@angular/router';
import * as $ from 'jquery';
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
    this.router.navigate(['/contribuable/']);
    this.contribuables = this.route.snapshot.data.contribuables;
    console.log(this.contribuables);
  }

  ngOnInit() {
    this.dtOptions = {
      pagingType: 'full_numbers',
      pageLength: 5,
      processing: true
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
