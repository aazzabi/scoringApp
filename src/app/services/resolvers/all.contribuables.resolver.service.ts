import {Resolve, ActivatedRoute, RouterStateSnapshot} from '@angular/router';
import {Observable} from 'rxjs';
import {Injectable} from '@angular/core';
import {StorageService} from '../security/storage.service';
import {ContribuableService} from '../manager/ContribuableService';

@Injectable()
export class AllContribuablesResolverService implements Resolve<any[]> {
  constructor(private contribuableService: ContribuableService) {}

  // @ts-ignore
  resolve(route: ActivatedRoute, state: RouterStateSnapshot): Observable<any[]> {
    return this.contribuableService.getAll();
  }
}
