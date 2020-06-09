import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {BehaviorSubject, Observable} from 'rxjs';
import {Tokens} from '../../models/Tokens';
import {map} from 'rxjs/operators';
import {StorageService} from './storage.service';
import {User} from '../../models/User';

const httpOptions = {
  headers: new HttpHeaders({
    'Access-Control-Allow-Methods': 'POST,GET,DELETE,PUT',
    'Access-Control-Allow-Headers': 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With',
    'Access-Control-Allow-Origin': '*',
    'Content-type': 'application/json',
  }),
};

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  constructor(private http: HttpClient) {
    this.currentUserSubject = new BehaviorSubject<User>(JSON.parse(localStorage.getItem('token')));
    this.currentUser = this.currentUserSubject.asObservable();
  }

  public get currentUserValue(): User {
    return this.currentUserSubject.value;
  }

  public static loggedUserId: number;
  private currentUserSubject: BehaviorSubject<User>;
  public currentUser: Observable<User>;
  private readonly JWT_TOKEN = 'JWT_TOKEN';
  private loggedUser: string;
  public token: string;

  static isLogged() {
    return !!StorageService.get('token');
  }

  login(email: string, password: string): Observable<any> {
    return this.http
      .post('/crudappEntrepriseLog/api/login', {email, password}, httpOptions)
      // tslint:disable-next-line:ban-types
      .pipe(map((objectJson: Object) => {
          const response = objectJson;
          // @ts-ignore
          const t = response && response.token;
          // @ts-ignore
          if (t && response.status === 200) {
            const expires = 1000 * 60 * 30;
            // @ts-ignore
            StorageService.set('token', response.token, expires);
            return true;
          } else {
            // return false to indicate failed login
            console.log('false');
            return false;
          }
        }
        )
      );
  }

  logout() {
    // remove user from local storage to log user out
    localStorage.removeItem('token');
    this.currentUserSubject.next(null);
  }

  isLoggedIn() {
    return !!this.getJwtToken();
  }

  getJwtToken() {
    return localStorage.getItem(this.JWT_TOKEN);
  }

  private doLoginUser(email: string, tokens: Tokens) {
    this.loggedUser = email;
    this.storeTokens(tokens);
  }

  private doLogoutUser() {
    this.loggedUser = null;
    this.removeTokens();
  }

  private storeTokens(tokens: Tokens) {
    localStorage.setItem(this.JWT_TOKEN, tokens.jwt);
  }

  private removeTokens() {
    localStorage.removeItem(this.JWT_TOKEN);
  }
}
