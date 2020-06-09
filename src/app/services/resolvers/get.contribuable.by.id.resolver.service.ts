import {ActivatedRoute, Resolve, RouterStateSnapshot} from '@angular/router';
import {Observable} from 'rxjs';
import {Injectable} from '@angular/core';
import {ContribuableService} from '../manager/ContribuableService';

@Injectable()
export class GetContribuableByIdResolverService implements Resolve<any> {
  constructor(private contribuableService: ContribuableService) {
  }

  // @ts-ignore
  resolve(route: ActivatedRoute, state: RouterStateSnapshot): Observable<any> {
    // @ts-ignore
    return this.contribuableService.getById(route.paramMap.get('id'));
  }
}
