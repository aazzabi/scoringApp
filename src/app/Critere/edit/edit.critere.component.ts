import {Component, OnInit} from '@angular/core';
import {FormArray, FormControl, FormGroup, Validators} from '@angular/forms';
import {AlertService} from '../../services/common/AlertService';
import {ActivatedRoute, Router} from '@angular/router';
import {CriteresService} from '../../services/manager/CriteresService';
import {ChoixService} from '../../services/manager/ChoixService';

@Component({
  // tslint:disable-next-line:component-selector
  selector: 'add-critere-root',
  templateUrl: './edit.critere.component.html',
})
export class EditCritereComponent implements OnInit {
  critere: any;
  choix: any[];
  critereEdit: any;

  constructor(private critereService: CriteresService,
              private route: ActivatedRoute,
              private choixService: ChoixService,
              private alertService: AlertService,
              private router: Router
  ) {
    this.critere = this.route.snapshot.data.critere;
    this.choix = this.route.snapshot.data.choix;
  }

  ngOnInit() {
    let bool ;
    if (this.critere.isActive === 1 ) {
      bool = 'true';
    } else {
      bool = 'false';
    }
    this.critereEdit = new FormGroup({
      libelle: new FormControl('', [Validators.required]),
      critereFilename: new FormControl('', [Validators.required]),
      isActive: new FormControl( bool , []),
      choices: new FormArray([])
    });
    this.initializeCritereForm();
    // this.critereEdit.get('choices').push(this.initFirstEmptyChoices());
  }

  // pour initialiser le formulaire
  initializeCritereForm() {
    this.critereEdit.get('libelle').setValue(this.critere.libelle);
    this.critereEdit.get('critereFilename').setValue(this.critere.critereFilename);
    this.critereEdit.get('isActive').setValue(this.critere.isActive);
    this.initializeChoices();
  }

  // pour initialiser les formulaire de choix
  initializeChoices() {
    this.choix.forEach(cx => {
      this.choicesControl.push(new FormGroup({
        id: new FormControl(cx.id),
        libelle: new FormControl(cx.libelle, Validators.required),
        note: new FormControl(cx.note, Validators.required),
        coefficient: new FormControl(cx.coefficient, Validators.required),
        pondere: new FormControl(cx.pondere, Validators.required),
      }));
    });
  }

  // intialize first empty form , ynajem yab9a feragh 3adi
  initFirstEmptyChoices() {
    return new FormGroup({
      libelle: new FormControl(''),
      note: new FormControl(''),
      coefficient: new FormControl(''),
      pondere: new FormControl(''),
    });
  }

  // initBed
  initEmptyChoices() {
    return new FormGroup({
      libelle: new FormControl('', Validators.required),
      note: new FormControl('', Validators.required),
      coefficient: new FormControl('', Validators.required),
      pondere: new FormControl('', Validators.required),
    });
  }


  get choicesControl() {
    return this.critereEdit.get('choices') as FormArray;
  }

  getChoices(form) {
    return form.controls.choices.controls;
  }

  addChoice() {
    return this.choicesControl.push(this.initEmptyChoices());
  }

  removeChoice(i: number) {
    return this.choicesControl.removeAt(i);
  }


  confirmEdit($event: MouseEvent) {
    console.log(this.critereEdit.value.isActive, 'form');
    let isvalide;
    if ((this.critereEdit.value.isActive === 0) || (this.critereEdit.value.isActive === false)  ) {
      isvalide = 0;
    } else if (this.critereEdit.value.isActive === 1 || (this.critereEdit.value.isActive === true)  ) {
      isvalide = 1;
    }
    console.log(isvalide , 'form');
    this.critereService.edit({
      id: this.critere.id,
      libelle: this.critereEdit.value.libelle,
      critereFilename: this.critereEdit.value.critereFilename,
      isActive: isvalide,
    }).subscribe(
      response => {
        console.log(response);
      }, error => {
        console.log(error);
      });

    this.critereEdit.value.choices.forEach((v) => {
      if (v.id) {
        this.choixService.edit({
          // @ts-ignore
          critere: this.critere.id,
          id: v.id,
          libelle: v.libelle,
          note: v.note,
          pondere: v.pondere,
          coefficient: v.coefficient,
        }).subscribe((responseCx) => {}, errorCx => {});
      } else {
        this.choixService.new({
          // @ts-ignore
          critere: this.critere.id,
          libelle: v.libelle,
          note: v.note,
          pondere: v.pondere,
          coefficient: v.coefficient,
        }).subscribe((responseCx) => {}, errorCx => {});
      }
    });
    this.router.navigateByUrl('/critere/all');

  }

}
