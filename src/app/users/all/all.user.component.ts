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
    this.dtOptions = {
      pagingType: 'full_numbers',
      pageLength: 5,
      processing: true
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
