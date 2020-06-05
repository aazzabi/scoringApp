import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, RouterStateSnapshot, CanActivate, Router } from '@angular/router';
import { DataserviceService } from 'src/app/services/dataservice.service';
import { Observable } from 'rxjs';
 
@Injectable({
  providedIn: 'root'
})
export class AuthguardGuard implements CanActivate  {
 
  constructor(private dataService: DataserviceService,private router: Router  ) {}
  
  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ): boolean | Observable<boolean> | Promise<boolean> {
    const isAuth = this.dataService.isLoggedIn();
    
    if (isAuth==false) {
      this.router.navigate(['/login']);
    }
    return isAuth;
  }

}
