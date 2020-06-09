import {
  HttpErrorResponse,
  HttpEvent,
  HttpHandler,
  HttpInterceptor,
  HttpRequest,
  HttpResponse
} from '@angular/common/http';
import {Injectable} from '@angular/core';
import {Observable} from 'rxjs';
import {Router} from '@angular/router';
import {StorageService} from './storage.service';

@Injectable()
export class AuthIntercepter implements HttpInterceptor {

  constructor(private router: Router) {}

  intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    if (StorageService.get('token')) {
      console.log(StorageService.get('token'));
      const token = StorageService.get('token');
      if (token) {
        const cloned = req.clone({
          headers: req.headers.set('Authorization', 'Bearer ' + token)
        });
        return  next.handle(cloned);
      } else {return next.handle(req); }
    } else {
      return next.handle(req);
    }
  }

}
