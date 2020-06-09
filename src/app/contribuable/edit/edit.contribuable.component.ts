import {Component, Input, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {ContribuableService} from '../../services/manager/ContribuableService';
import {AlertService} from '../../services/common/AlertService';
import {ActivatedRoute, Router} from '@angular/router';
import {NgbActiveModal} from '@ng-bootstrap/ng-bootstrap';

@Component({
  // tslint:disable-next-line:component-selector
  selector: 'add-contribuable-root',
  templateUrl: './edit.contribuable.component.html',
})
export class EditContribuableComponent implements OnInit {
  @Input()
  contribuableToEdit: any;
  // tslint:disable-next-line:max-line-length
  constructor(private contribuableService: ContribuableService,
              private alertService: AlertService,
              private router: Router,
              private route: ActivatedRoute,
              public activeModal: NgbActiveModal) {}

  contribuableEdit = new FormGroup({
    libelle: new FormControl('', [Validators.required]),
    activite: new FormControl('', [Validators.required]),
    formeJuridique: new FormControl('' , [Validators.required]),
  });

  ngOnInit() {
    console.log(this.contribuableToEdit.id, 'contribuableToEdit');
    this.contribuableEdit.get('libelle').setValue(this.contribuableToEdit.libelle);
    this.contribuableEdit.get('activite').setValue(this.contribuableToEdit.activite);
    this.contribuableEdit.get('formeJuridique').setValue(this.contribuableToEdit.formeJuridique);
  }

  confirm($event: MouseEvent) {
    this.contribuableService.edit({
      id: this.contribuableToEdit.id,
      libelle: this.contribuableEdit.value.libelle,
      activite: this.contribuableEdit.value.activite,
      formeJuridique: this.contribuableEdit.value.formeJuridique,
    }).subscribe(
      response => {
        console.log(response);
        // @ts-ignore
        this.alertService.success(response, true);
        this.activeModal.close();
        this.router.navigateByUrl('/contribuable');
      },
      error => {
        this.activeModal.close();
        window.location.reload();
        // this.router.navigateByUrl('/contribuable');
      }
    );


  }
}
