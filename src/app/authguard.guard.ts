import {Injectable} from '@angular/core';
import {ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot} from '@angular/router';
import {DataserviceService} from 'src/app/services/dataservice.service';
import {Observable} from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthguardGuard implements CanActivate {

  constructor(private dataService: DataserviceService, private router: Router) {
  }

  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ): boolean | Observable<boolean> | Promise<boolean> {
    console.log('canActivate');
    const isAuth = this.dataService.isLoggedIn();

    if (isAuth === false) {
      console.log('isAuth == false');
      this.router.navigate(['/login']);
    }
    return isAuth;
  }

}
