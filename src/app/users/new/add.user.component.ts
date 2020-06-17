import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, ValidatorFn, Validators} from '@angular/forms';
import {UsersService} from '../../services/manager/UserService';
import {AlertService} from '../../services/common/AlertService';
import {Router} from '@angular/router';

@Component({
  // tslint:disable-next-line:component-selector
  selector: 'add-user-root',
  templateUrl: './add.user.component.html',
})
export class AddUserComponent implements OnInit {
  user = new FormGroup({
    nom: new FormControl('', [Validators.required, Validators.minLength(3), Validators.maxLength(10)]),
    prenom: new FormControl('', [Validators.required, Validators.minLength(3), Validators.maxLength(10)]),
    username: new FormControl('', [Validators.required, Validators.minLength(3), Validators.maxLength(10)]),
    email: new FormControl('', [Validators.required, Validators.email]),
    role: new FormControl('', [Validators.required]),
    password: new FormControl('', [Validators.required]),
  });

  confirmPassword = new FormControl('', [this.sameValueAs(this.user, 'password')]);

  constructor(private userService: UsersService, private alertService: AlertService, private router: Router) {
    this.user.addControl('confirmPassword', this.confirmPassword);
  }

  ngOnInit() {
  }

  confirm($event: MouseEvent) {
    this.userService.new({
      nom: this.user.value.nom,
      prenom: this.user.value.prenom,
      email: this.user.value.email,
      username: this.user.value.username,
      role: this.user.value.role,
      password: this.user.value.password,
    }).subscribe(
      response => {
        var data = JSON.parse(response);
        console.log(data);
        this.router.navigateByUrl('/users/all');
        this.alertService.success(data.message);
      },
      error => {
        this.alertService.error(error.message);
        console.log(error);
      }
    );
  }

  sameValueAs(group: FormGroup, controlName: string): ValidatorFn {
    return (control: FormControl) => {
      const myValue = control.value;
      const compareValue = group.controls[controlName].value;
      return (myValue === compareValue) ? null : {valueDifferentFrom: controlName};
    };
  }
}
