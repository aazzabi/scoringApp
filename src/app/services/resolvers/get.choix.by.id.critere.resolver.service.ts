import {ActivatedRoute, Resolve, RouterStateSnapshot} from '@angular/router';
import {Observable} from 'rxjs';
import {Injectable} from '@angular/core';
import {CriteresService} from '../manager/CriteresService';
import {ChoixService} from '../manager/ChoixService';

@Injectable()
export class GetChoixByIdCritereResolverService implements Resolve<any> {
  constructor(private choixService: ChoixService) {
  }

  // @ts-ignore
  resolve(route: ActivatedRoute, state: RouterStateSnapshot): Observable<any> {
    // @ts-ignore
    return this.choixService.getAllChoixByCritere(route.paramMap.get('id'));
  }
}
