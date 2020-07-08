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
    coefficient: new FormControl('', [Validators.required]),
    isActive: new FormControl(0, []),
  });
  critereResponse = {};

  ngOnInit() {
  }

  confirm($event: MouseEvent) {
    console.log(this.critere.value, 'form');
    this.critereService.configFilnameExists({critereFilename: this.critere.value.critereFilename}).subscribe((d) => {
      this.critereService.new({
        libelle: this.critere.value.libelle,
        critereFilename: this.critere.value.critereFilename,
        isActive: this.critere.value.isActive,
        coefficient: this.critere.value.coefficient,
        createdBy: StorageService.decodeToken().data.id,
      }).subscribe(
        response => {
          console.log(response, 'response');
          this.router.navigateByUrl('/critere/all');
        }, error => {
          this.alertService.error(error.message);
          console.log(error);
        });
    }, err => {
      this.alertService.error('Un critére existe deja avec ce meme nom de fichier de configuration ');
    });
  }

}
