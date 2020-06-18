import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders, HttpParams} from '@angular/common/http';
import {User} from '../../models/User';


const httpOptions = {
  headers: new HttpHeaders({
    'Content-Type': 'application/json',
    'Access-Control-Allow-Methods': 'POST,GET,DELETE,PUT'
  }),
  responseType: 'text' as 'text'
};

@Injectable()
export class UsersService {

  constructor(private http: HttpClient) {
  }

  url = '/crudappEntrepriseLog/api/users/';

  getAll() {
    return this.http.get<any[]>(this.url + 'all');
  }

  edit(user) {
    const body = JSON.stringify(user);
    return this.http.put(this.url + 'edit', body, httpOptions);
  }

  new(u: any) {
    return this.http.post(this.url + 'new/', u, httpOptions);
  }

  emailExists(u: any) {
    return this.http.post(this.url + 'emailExists/', u, httpOptions);
  }

  delete(u: any) {
    return this.http.delete(this.url + 'delete.php?id=' + u.id);
  }

  getById(id: string) {
    const params = new HttpParams().set('id', id.toString());
    return this.http.get(this.url + 'getById?id=' + id, httpOptions);
  }

  getCalcule(id: string) {
    return this.http.get('/crudappEntrepriseLog/api/Utils/calculateAllScores.php?id=' + id, httpOptions);
  }
}
