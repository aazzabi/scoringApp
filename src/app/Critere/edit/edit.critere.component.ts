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
  boolActive: any;
  isActiveEdit: any;

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
      coefficient: new FormControl('', [Validators.required]),
      isActive: new FormControl( bool , []),
    });
    this.initializeCritereForm();
  }

  // pour initialiser le formulaire
  initializeCritereForm() {
    console.log(this.critere.coefficient, 'this.critere.coefficient')
    this.critereEdit.get('libelle').setValue(this.critere.libelle);
    this.critereEdit.get('critereFilename').setValue(this.critere.critereFilename);
    this.critereEdit.get('coefficient').setValue(this.critere.coefficient);
    if (this.critere.isActive == 1 ) {
        this.boolActive = true;
    } else {
      this.boolActive = false;
    }
  }

  confirmEdit($event: MouseEvent) {
    if ( (this.critereEdit.value.isActive === 'false') || (this.critereEdit.value.isActive === false) ) {
      this.isActiveEdit = 0;
    } else if ( (this.critereEdit.value.isActive === 'true') || (this.critereEdit.value.isActive === true))  {
      this.isActiveEdit = 1;
    }
    this.critereService.edit({
      id: this.critere.id,
      libelle: this.critereEdit.value.libelle,
      coefficient: this.critereEdit.value.coefficient,
      critereFilename: this.critereEdit.value.critereFilename,
      isActive: this.isActiveEdit,
    }).subscribe(
      response => {
        console.log(response);
      }, error => {
        console.log(error);
      });

    this.router.navigateByUrl('/critere/all');

  }

}
