import { Component, OnInit } from '@angular/core';
import { User } from 'src/app/models/User';
import { Router } from '@angular/router';
import { DataserviceService } from 'src/app/services/dataservice.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  constructor(private dataService: DataserviceService,private router:Router) {
      }
      Login: User = new User();
  ngOnInit() {
  }
  postdata()
  {
    this.dataService.userlogin(this.Login).subscribe(data=>this.router.navigate(['/menu'])),
          error => {
              alert("User name or password is incorrect")
          };
  }


}
