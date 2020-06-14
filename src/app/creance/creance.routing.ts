import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {AuthGuard} from '../services/security/auth.guard';
import {AllCreancesComponent} from './all/all.creances.component';
import {AllCreancesResolverService} from '../services/resolvers/all.creances.resolver.service';

const routes: Routes = [
  {
    path: '', component: AllCreancesComponent, resolve: { creances: AllCreancesResolverService}, canActivate: [AuthGuard]
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CreanceRouting {
}

