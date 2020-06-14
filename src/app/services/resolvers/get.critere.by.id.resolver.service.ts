import {ActivatedRoute, Resolve, RouterStateSnapshot} from '@angular/router';
import {Observable} from 'rxjs';
import {Injectable} from '@angular/core';
import {CriteresService} from '../manager/CriteresService';

@Injectable()
export class GetCritereByIdResolverService implements Resolve<any> {
  constructor(private critereService: CriteresService) {
  }

  // @ts-ignore
  resolve(route: ActivatedRoute, state: RouterStateSnapshot): Observable<any> {
    // @ts-ignore
    return this.critereService.getById(route.paramMap.get('id'));
  }
}
