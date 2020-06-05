import { Component, OnInit } from '@angular/core';
import { User } from 'src/app/models/User';

import { Router } from '@angular/router';
import { DataserviceService } from 'src/app/services/dataservice.service';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {

  constructor(private dataService: DataserviceService,private router:Router) {
  }

  ngOnInit() {
  }
 logout() {
    this.dataService.deleteToken();
    this.router.navigate(['/login']);

    }
}
