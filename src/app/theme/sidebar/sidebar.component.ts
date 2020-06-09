import {Component, OnInit} from '@angular/core';
import {StorageService} from '../../services/security/storage.service';

// declare const $: any;
// declare var jQuery: any;
import * as $ from 'jquery';
import {Router} from '@angular/router';


declare interface RouteInfo {
  path: string;
  title: string;
  icon: string;
  class: string;
  rolesAllowed: any[];
}

export const ROUTES: RouteInfo[] = [
  // {path: '/dashboard', title: 'Dashboard', icon: 'pe-7s-graph', class: '', rolesAllowed: ['ADMIN', 'USER']},
  {path: '/users', title: 'Utilisateurs', icon: 'pe-7s-user', class: '', rolesAllowed: ['ADMIN']},
  {path: '/contribuable', title: 'Contribuable', icon: 'pe-7s-note2', class: '', rolesAllowed: ['ADMIN' , 'AGENT']},
  // {path: '/table', title: 'Table List', icon: 'pe-7s-note2', class: '', rolesAllowed: ['ADMIN' , 'USER']},
  // {path: '/typography', title: 'Typography', icon: 'pe-7s-news-paper', class: '', rolesAllowed: ['ADMIN']},
  // {path: '/icons', title: 'Icons', icon: 'pe-7s-science', class: '', rolesAllowed: ['ADMIN']},
  // {path: '/maps', title: 'Maps', icon: 'pe-7s-map-marker', class: '', rolesAllowed: ['ADMIN']},
  // {path: '/notifications', title: 'Notifications', icon: 'pe-7s-bell', class: '', rolesAllowed: ['ADMIN']},
  // {path: '/upgrade', title: 'Upgrade to PRO', icon: 'pe-7s-rocket', class: 'active-pro', rolesAllowed: ['ADMIN']},
];

@Component({
  selector: 'app-sidebar',
  templateUrl: './sidebar.component.html'
})
export class SidebarComponent implements OnInit {
  menuItems: any[];
  role: string;

  constructor(private router: Router) {
    if (StorageService.get('token')) {
      console.log(StorageService.decodeToken().data.role);
      this.role = StorageService.decodeToken().data.role;
    }
  }

  ngOnInit() {
    this.menuItems = ROUTES.filter(menuItem => menuItem);
  }

  isMobileMenu() {
    if ($(window).width() > 991) {
      return false;
    }
    return true;
  };

  logout() {
    this.router.navigate(['/login']);
    StorageService.clear('token');
  }
}
