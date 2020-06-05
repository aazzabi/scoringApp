import {EventEmitter, Injectable, Output} from '@angular/core';
import {map} from 'rxjs/operators';
import {HttpClient} from '@angular/common/http';
import {User} from 'src/app/models/User';
import {Observable} from 'rxjs';


@Injectable({
  providedIn: 'root'
})
export class DataserviceService {
  redirectUrl: string;

  // baseUrl:string = "http://localhost/crudappEntrepriseLog/api";
  @Output() getLoggedInName: EventEmitter<any> = new EventEmitter();
  private isAuthenticated = false;

  constructor(private http: HttpClient) {
  }

  userlogin(Login: User): Observable<User[]> {

    return this.http.post<User[]>('http://localhost/crudappEntrepriseLog/api/login', {data: Login})
      // tslint:disable-next-line:no-shadowed-variable
      .pipe(map(User => {
        this.setToken(Login.email);
        this.getLoggedInName.emit(true);
        this.isAuthenticated = true;
        return User;
      }));
  }


//token
  setToken(token: string) {
    localStorage.setItem('token', token);
  }

  getToken() {
    return localStorage.getItem('token');
  }

  deleteToken() {
    localStorage.removeItem('token');
  }

  isLoggedIn() {
    return this.isAuthenticated;
  }

}
