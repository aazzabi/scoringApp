import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';

const httpOptions = {
  headers: new HttpHeaders({
    'Access-Control-Allow-Methods': 'POST,GET,DELETE,PUT',
    'Access-Control-Allow-Headers': 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With',
    'Access-Control-Allow-Origin': '*',
    'Content-type': 'application/json',
  }),
};

@Injectable()
export class ContribuableService {

  constructor(private http: HttpClient) {
  }

  url = '/crudappEntrepriseLog/api/contribuables/';

  getAll() {
    console.log('get all');
    return this.http.get<any[]>(this.url + 'all');
  }

  edit(contribuble) {
    const body = JSON.stringify(contribuble);
    return this.http.put(this.url + 'edit', body, httpOptions);
  }

  new(contribuble) {
    const body = JSON.stringify(contribuble);
    return this.http.post(this.url + 'new', body, httpOptions);
  }

  delete(u: any) {
    return this.http.delete(this.url + 'delete?id=' + u.id);
  }

  getById(id: any) {
    console.log(this.http.get<any>(this.url + 'getById?id=' + id), 'get');
    console.log(this.http.get<any[]>(this.url + 'all'), 'all');
    return this.http.get<any[]>(this.url + 'getById?id=' + id);
  }


}
