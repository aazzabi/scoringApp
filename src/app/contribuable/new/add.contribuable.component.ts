import {Component, OnInit} from '@angular/core';
import {Location} from '@angular/common';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {ContribuableService} from '../../services/manager/ContribuableService';
import {UsersService} from '../../services/manager/UserService';
import {AlertService} from '../../services/common/AlertService';
import {Router} from '@angular/router';

@Component({
  // tslint:disable-next-line:component-selector
  selector: 'add-contribuable-root',
  templateUrl: './add.contribuable.component.html',
})
export class AddContribuableComponent implements OnInit  {
  contribuable = new FormGroup({
    libelle: new FormControl('', [Validators.required, Validators.minLength(3), Validators.maxLength(10)]),
    activite: new FormControl('', [Validators.required, Validators.minLength(3), Validators.maxLength(10)]),
    formeJuridique: new FormControl('', [Validators.required]),
  });
  constructor(private contribuableService: ContribuableService,  private alertService: AlertService, private router: Router) {
  }

  ngOnInit() {
  }

  confirm($event: MouseEvent) {
    this.contribuableService.new({
      libelle: this.contribuable.value.libelle,
      activite: this.contribuable.value.activite,
      formeJuridique: this.contribuable.value.formeJuridique,
    }).subscribe(
      response => {
        console.log(response);
        // @ts-ignore
        this.alertService.success(response.message, true);
        this.router.navigateByUrl('/contribuable');
      },
      error => {
        this.alertService.error(error.message);
        console.log(error);
      }
    );

  }
}
