import {Component, OnInit} from '@angular/core';
import {Location} from '@angular/common';
import {ActivatedRoute, Router} from '@angular/router';
import {ContribuableService} from '../../services/manager/ContribuableService';
import {UsersService} from '../../services/manager/UserService';
import {EditContribuableComponent} from '../../contribuable/edit/edit.contribuable.component';
import {BsModalService} from 'ngx-bootstrap/modal';
import {NgbModal} from '@ng-bootstrap/ng-bootstrap';
import {CriteresService} from '../../services/manager/CriteresService';

@Component({
  // tslint:disable-next-line:component-selector
  selector: 'all-critere-root',
  templateUrl: './all.critere.component.html',
})
export class AllCritereComponent implements OnInit  {
  criteres: any[];
  dtOptions: DataTables.Settings = {};

  constructor(
    private modalService: NgbModal,
    private critereServices: CriteresService,
    private route: ActivatedRoute,
    private router: Router,
  ) {
    this.criteres = this.route.snapshot.data.criteres;
    console.log(this.criteres , 'criteres');
  }

  ngOnInit() {
    // this.critereServices.getCalcule('999').subscribe((response) => console.log(response, '******'));

    this.dtOptions = {
      pagingType: 'full_numbers',
      pageLength: 5,
      processing: true
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
}
