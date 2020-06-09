import {Injectable} from '@angular/core';
import {ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot} from '@angular/router';
import {StorageService} from './storage.service';
import {LoginService} from './login.service';

@Injectable()
export class RoleGuard implements CanActivate {

  constructor(
    private router: Router,
  ) {
  }

  canActivate(next: ActivatedRouteSnapshot, state: RouterStateSnapshot): boolean {
    if (!StorageService.get('token')) {
      const rolesAllowed = next.data.roles as Array<string>;
      const user = StorageService.get('token');
      if (rolesAllowed) {
        // check if user is allowed
        const match = rolesAllowed.find(ob => ob === user.role);
        if (match != null) {
          console.log('maatch true' + match);
          return true;
        } else {
          console.log('maatch false');
          this.router.navigate(['/']);
          return false;
        }
      } else {
        this.router.navigate(['/']);
      }
    } else {
      this.router.navigate(['/login']);
    }
    return false;
  }
}
