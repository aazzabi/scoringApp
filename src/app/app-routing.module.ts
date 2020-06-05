import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';

import {ListentrepriseComponent} from 'src/app/entreprise/listentreprise/listentreprise.component';
import {AjoutentrepriseComponent} from 'src/app/entreprise/ajoutentreprise/ajoutentreprise.component';
import {UpdateentrepriseComponent} from 'src/app/entreprise/updateentreprise/updateentreprise.component';

import {MenuComponent} from './menu/menu.component';
import {LoginComponent} from './login/login.component';
import {AuthguardGuard} from './authguard.guard';

const routes: Routes = [
  {path: 'menu/entreprises', component: ListentrepriseComponent},
  {path: 'addentreprise', component: AjoutentrepriseComponent, canActivate: [AuthguardGuard]},
  {path: 'menu/editentreprise/:_id', component: UpdateentrepriseComponent, canActivate: [AuthguardGuard]},
  {path: 'login', component: LoginComponent},
  {path: '', component: LoginComponent},
  {path: 'menu', component: MenuComponent, canActivate: [AuthguardGuard]}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {
}
