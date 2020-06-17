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
  selector: 'show-critere-root',
  templateUrl: './show.critere.component.html',
})
export class ShowCritereComponent implements OnInit  {
  critere: any;
  loggedUser: any;
  choix: any[];
  dtOptions: DataTables.Settings = {};

  constructor(
    private modalService: NgbModal,
    private critereServices: CriteresService,
    private route: ActivatedRoute,
    private router: Router,
  ) {
    this.critere = this.route.snapshot.data.critere;
    this.choix = this.route.snapshot.data.choix;
    this.loggedUser = StorageService.decodeToken().data;
  }

  ngOnInit() {
    // this.critereServices.getCalcule('999').subscribe((response) => console.log(response, '******'));
    this.dtOptions = {
      pagingType: 'full_numbers',
      pageLength: 5,
      processing: true
    };
  }

  // delete(c: any, i: any) {
  //   if (confirm('Vous allez supprimer ce critere ! \n etes-vous sure ?')) {
  //     this.critereServices.deleteChoix(c).subscribe(
  //       response => {
  //         this.choix.splice(i, 1);
  //       },
  //       error => {
  //         console.log(error);
  //       }
  //     );
  //   }
  // }

  activateCritere(id: any) {
    this.critereServices.activate(id).subscribe((data) => {
      this.critere.isActive = true;
    }, error => {
      this.critere.isActive = true;
    });
  }
  desactivateCritere(id: any) {
    this.critereServices.desactivate(id).subscribe((data) => {
      this.critere.isActive = false;
    }, error => {
      this.critere.isActive = false;
    });

  }
}
