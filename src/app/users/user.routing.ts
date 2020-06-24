import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';

import {AllUserComponent} from './all/all.user.component';
import {AddUserComponent} from './new/add.user.component';
import {EditUserComponent} from './edit/edit.user.component';
import {AllUsersResolverService} from '../services/resolvers/all.users.resolver.service';
import {RoleGuard} from '../services/security/role.guard';

const routes: Routes = [
  {
    path: 'all',
    component: AllUserComponent,
    resolve: {users: AllUsersResolverService},
    canActivate: [RoleGuard],
    data: {roles: ['ADMIN']},
  },
  {path: 'add', component: AddUserComponent, canActivate: [RoleGuard], data: {roles: ['ADMIN']}},
  {path: 'edit/:id', component: EditUserComponent, /*resolve: {user: GetUserByIdResolverService}*/},
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class UserRouting {
}

