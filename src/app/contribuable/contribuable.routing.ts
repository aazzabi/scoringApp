import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';

import {AllContribuableComponent} from './all/all.contribuable.component';
import {AddContribuableComponent} from './new/add.contribuable.component';
import {EditContribuableComponent} from './edit/edit.contribuable.component';
import {AuthGuard} from '../services/security/auth.guard';
import {AllContribuablesResolverService} from '../services/resolvers/all.contribuables.resolver.service';
import {GetContribuableByIdResolverService} from '../services/resolvers/get.contribuable.by.id.resolver.service';

const routes: Routes = [
  {path: 'add', component: AddContribuableComponent},
  {path: 'edit/:id', component: EditContribuableComponent, resolve : { contribuable: GetContribuableByIdResolverService}},
  {path: '', component: AllContribuableComponent,
    resolve : { contribuables: AllContribuablesResolverService }, canActivate: [AuthGuard]
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ContribuableRouting {
}

