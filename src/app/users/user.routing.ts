import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';

import {AllUserComponent} from './all/all.user.component';
import {AuthguardGuard} from '../authguard.guard';
import {AddUserComponent} from './new/add.user.component';
import {EditUserComponent} from './edit/edit.user.component';
import {AllUsersResolverService} from '../services/resolvers/all.users.resolver.service';
import {GetUserByIdResolverService} from '../services/resolvers/get.user.by.id.resolver.service';

const routes: Routes = [
  {path: '', component: AllUserComponent, resolve: {users: AllUsersResolverService}},
  {path: 'add', component: AddUserComponent/*, canActivate: [AuthguardGuard]*/},
  {path: 'edit/:id', component: EditUserComponent, /*resolve: {user: GetUserByIdResolverService}*/},
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class UserRouting {
}

