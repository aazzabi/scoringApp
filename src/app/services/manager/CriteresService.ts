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
export class CriteresService {

  constructor(private http: HttpClient) {
  }

  url = '/crudappEntrepriseLog/api/critere/';

  getAll() {
    return this.http.get<any[]>(this.url + 'all');
  }

  edit(contribuble) {
    const body = JSON.stringify(contribuble);
    return this.http.post(this.url + 'edit', body, httpOptions);
  }

  desactivate(id) {
    return this.http.get(this.url + 'desactivate?id=' + id);
  }

  activate(id) {
    return this.http.get(this.url + 'activate?id=' + id);
  }

  new(contribuble) {
    const body = JSON.stringify(contribuble);
    return this.http.post(this.url + 'new', body, httpOptions);
  }

  configFilnameExists(body) {
    console.log(body);
    return this.http.post(this.url + 'configFilnameExists', body, httpOptions);
  }

  delete(u: any) {
    return this.http.delete(this.url + 'delete?id=' + u.id);
  }

  getById(id: any) {
    return this.http.get<any[]>(this.url + 'getById?id=' + id);
  }


}
