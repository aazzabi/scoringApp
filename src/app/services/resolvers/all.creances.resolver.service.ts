import {ActivatedRoute, Resolve, RouterStateSnapshot} from '@angular/router';
import {Observable} from 'rxjs';
import {Injectable} from '@angular/core';
import {CriteresService} from '../manager/CriteresService';
import {CreancesService} from '../manager/CreancesService';

@Injectable()
export class AllCreancesResolverService implements Resolve<any[]> {
  constructor(private creanceService: CreancesService) {
  }

  // @ts-ignore
  resolve(route: ActivatedRoute, state: RouterStateSnapshot): Observable<any[]> {
    return this.creanceService.getAll();
  }
}
