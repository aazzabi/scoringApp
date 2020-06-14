import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {AllCritereComponent} from './all/all.critere.component';
import {AddCritereComponent} from './new/add.critere.component';
import {EditCritereComponent} from './edit/edit.critere.component';
import {AllCritereResolverService} from '../services/resolvers/all.criteres.resolver.service';
import {ShowCritereComponent} from './show/show.critere.component';
import {GetCritereByIdResolverService} from '../services/resolvers/get.critere.by.id.resolver.service';
import {GetChoixByIdCritereResolverService} from '../services/resolvers/get.choix.by.id.critere.resolver.service';

const routes: Routes = [
  {path: 'all', component: AllCritereComponent, resolve: {criteres: AllCritereResolverService}},
  {path: 'add', component: AddCritereComponent/*, canActivate: [AuthguardGuard]*/},
  {
    path: 'edit/:id',
    component: EditCritereComponent,
    resolve: {critere: GetCritereByIdResolverService, choix: GetChoixByIdCritereResolverService}
  },
  {
    path: 'show/:id',
    component: ShowCritereComponent,
    resolve: {critere: GetCritereByIdResolverService, choix: GetChoixByIdCritereResolverService}
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CritereRouting {
}

