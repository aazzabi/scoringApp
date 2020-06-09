import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {AdminLayoutComponent} from './theme/layouts/admin-layout/admin-layout.component';
import {BrowserModule} from '@angular/platform-browser';
import {CommonModule} from '@angular/common';
import {AuthguardGuard} from './authguard.guard';
import {LoginComponent} from './login/login.component';
import {AuthGuard} from './services/security/auth.guard';
import {AppComponent} from './app.component';

const routes: Routes = [
  // {path: 'menu/entreprises', component: ListentrepriseComponent},
  // {path: 'addentreprise', component: AjoutentrepriseComponent, canActivate: [AuthguardGuard]},
  // {path: 'menu/editentreprise/:_id', component: UpdateentrepriseComponent, canActivate: [AuthguardGuard]},
  {path: 'login', component: LoginComponent},

  {
    path: '',
    component: AdminLayoutComponent,
    children: [
      {
        path: 'users',
        canActivateChild: [AuthGuard],
        loadChildren: './users/user.module#UserModule'
      },
      {
        path: 'contribuable',
        canActivateChild: [AuthGuard],
        loadChildren: './contribuable/contribuable.module#ContribuableModule'
      },
    ]
  },
  {
    path: '',
    redirectTo: 'login',
    pathMatch: 'full',
  },
  {
    path: '**',
    redirectTo: 'dashboard'
  }

];

export const ROUTING = RouterModule.forRoot(routes);
