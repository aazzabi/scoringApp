import {Component, OnInit} from '@angular/core';
import {FormArray, FormControl, FormGroup, Validators} from '@angular/forms';
import {AlertService} from '../../services/common/AlertService';
import {Router} from '@angular/router';
import {CriteresService} from '../../services/manager/CriteresService';
import {ChoixService} from '../../services/manager/ChoixService';
import {StorageService} from '../../services/security/storage.service';

@Component({
  // tslint:disable-next-line:component-selector
  selector: 'add-critere-root',
  templateUrl: './add.critere.component.html',
})
export class AddCritereComponent implements OnInit {


  constructor(private critereService: CriteresService, private choixService: ChoixService, private alertService: AlertService, private router: Router) {
  }

  get choicesControl() {
    return this.critere.get('choices') as FormArray;
  }

  critere = new FormGroup({
    libelle: new FormControl('', [Validators.required]),
    critereFilename: new FormControl('', [Validators.required]),
    isActive: new FormControl(0, []),
    choices: new FormArray([this.initChoices(),])
  });
  critereResponse = {};

  ngOnInit() {
  }

  getChoices(form) {
    return form.controls.choices.controls;
  }

  addChoice() {
    return this.choicesControl.push(this.initChoices());
  }

  removeChoice(i: number) {
    return this.choicesControl.removeAt(i);
  }

  // initBed
  initChoices() {
    return new FormGroup({
      libelle: new FormControl('', Validators.required),
      note: new FormControl('', Validators.required),
      coefficient: new FormControl('', Validators.required),
      pondere: new FormControl('', Validators.required),
    });
  }
  confirm($event: MouseEvent) {
    console.log(this.critere.value, 'form');
    this.critereService.new({
      libelle: this.critere.value.libelle,
      critereFilename: this.critere.value.critereFilename,
      isActive: this.critere.value.isActive,
      createdBy: StorageService.decodeToken().data.id,
    }).subscribe(
      response => {
        this.critere.value.choices.forEach((v) => {
          this.choixService.new({
            // @ts-ignore
            critere: response.lastInsertId,
            libelle: v.libelle,
            note: v.note,
            pondere: v.pondere,
            coefficient: v.coefficient,
          }).subscribe((responseCx) => {
            console.log(responseCx, 'response CX');
          }, errorCx => {
            console.log(errorCx, 'errorCx');
          });
        });
        this.router.navigateByUrl('/critere/all');
      }, error => {
        this.alertService.error(error.message);
        console.log(error);
      });
  }

}
