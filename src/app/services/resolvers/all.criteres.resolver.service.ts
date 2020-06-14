import {ActivatedRoute, Resolve, RouterStateSnapshot} from '@angular/router';
import {Observable} from 'rxjs';
import {Injectable} from '@angular/core';
import {CriteresService} from '../manager/CriteresService';

@Injectable()
export class AllCritereResolverService implements Resolve<any[]> {
  constructor(private critereService: CriteresService) {
  }

  // @ts-ignore
  resolve(route: ActivatedRoute, state: RouterStateSnapshot): Observable<any[]> {
    console.log('resolver critere ');
    return this.critereService.getAll();
  }
}
