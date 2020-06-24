import {Component, OnInit} from '@angular/core';

import {Router} from '@angular/router';
import {StorageService} from '../services/security/storage.service';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {

  constructor(private router: Router) {
  }

  ngOnInit() {
  }

  logout() {
    StorageService.clear('token');
    this.router.navigate(['/login']);

  }
}
