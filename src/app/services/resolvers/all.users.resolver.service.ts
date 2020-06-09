import {Resolve, ActivatedRoute, RouterStateSnapshot} from '@angular/router';
import {Observable} from 'rxjs';
import {Injectable} from '@angular/core';
import {UsersService} from '../manager/UserService';

@Injectable()
export class AllUsersResolverService implements Resolve<any[]> {
  constructor(private userService: UsersService) {}

  // @ts-ignore
  resolve(route: ActivatedRoute, state: RouterStateSnapshot): Observable<any[]> {
    return this.userService.getAll();
  }
}
