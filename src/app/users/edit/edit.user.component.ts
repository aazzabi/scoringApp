import {Component, Input, OnInit} from '@angular/core';
import {FormControl, FormGroup, ValidatorFn, Validators} from '@angular/forms';
import {UsersService} from '../../services/manager/UserService';
import {AlertService} from '../../services/common/AlertService';
import {ActivatedRoute, Router} from '@angular/router';
import {NgbActiveModal} from '@ng-bootstrap/ng-bootstrap';

@Component({
  // tslint:disable-next-line:component-selector
  selector: 'add-user-root',
  templateUrl: './edit.user.component.html',
})
export class EditUserComponent implements OnInit {
  id = this.route.snapshot.params.id;
  @Input()
  userToEdit: any;

  userEdit = new FormGroup({
    nom: new FormControl('', [Validators.required, Validators.minLength(3), Validators.maxLength(10)]),
    prenom: new FormControl('', [Validators.required, Validators.minLength(3), Validators.maxLength(10)]),
    username: new FormControl('', [Validators.required, Validators.minLength(3), Validators.maxLength(10)]),
    email: new FormControl('', [Validators.required, Validators.email]),
    role: new FormControl('', [Validators.required]),
    password: new FormControl('', [Validators.required]),
  });

  confirmPassword = new FormControl('', [this.sameValueAs(this.userEdit, 'password')]);

  // tslint:disable-next-line:max-line-length
  constructor(private userService: UsersService, private alertService: AlertService,
              public activeModal: NgbActiveModal,
              private router: Router, private route: ActivatedRoute) {
    this.userEdit.addControl('confirmPassword', this.confirmPassword);
  }

  ngOnInit() {
    console.log(this.userToEdit, 'userToEdit');
    this.userEdit.get('nom').setValue(this.userToEdit.nom);
    this.userEdit.get('prenom').setValue(this.userToEdit.prenom);
    this.userEdit.get('username').setValue(this.userToEdit.username);
    this.userEdit.get('email').setValue(this.userToEdit.email);
    this.userEdit.get('role').setValue(this.userToEdit.role);
    this.userEdit.get('password').setValue('');
  }

  sameValueAs(group: FormGroup, controlName: string): ValidatorFn {
    return (control: FormControl) => {
      const myValue = control.value;
      const compareValue = group.controls[controlName].value;
      return (myValue === compareValue) ? null : {valueDifferentFrom: controlName};
    };
  }

  confirmEdit($event: MouseEvent) {
    this.userService.edit({
      id: this.userToEdit.id,
      nom: this.userEdit.value.nom,
      prenom: this.userEdit.value.prenom,
      email: this.userEdit.value.email,
      role: this.userEdit.value.role,
      password: this.userEdit.value.password,
    }).subscribe(
      response => {
        console.log(response);
        // @ts-ignore
        this.alertService.success(response, true);
        this.activeModal.close();
        this.router.navigateByUrl('/users');
      },
      error => {
        this.activeModal.close();
        window.location.reload();
        // this.router.navigateByUrl('/contribuable');
      }
    );

  }

}
