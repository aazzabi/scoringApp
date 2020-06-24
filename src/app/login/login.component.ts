import {Component, OnInit} from '@angular/core';
import {User} from 'src/app/models/User';
import {Router} from '@angular/router';
import {LoginService} from '../services/security/login.service';
import {AlertService} from '../services/common/AlertService';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  login: User = new User();
  model: any = {};
  returnUrl = '';

  constructor(private alertService: AlertService,
              private loginService: LoginService,
              private router: Router) {
  }

  ngOnInit() {
  }


  Login() {
    this.loginService.login(this.model.email, this.model.password)
      .subscribe(
        (response) => {
          if (this.returnUrl) {
            this.router.navigateByUrl(this.returnUrl);
          } else {
            this.router.navigate(['/creance']);
          }
        },
        error => {
          console.log(error, 'error');
          this.alertService.error(error);
        }
      );
  }


}
