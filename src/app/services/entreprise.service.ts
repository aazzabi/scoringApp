import {Injectable} from '@angular/core';
import {HttpClient, HttpParams} from '@angular/common/http';
import {Observable} from 'rxjs';
import {map} from 'rxjs/operators';
import {Entreprise} from '../models/Entreprise';


@Injectable({
  providedIn: 'root'
})
export class EntrepriseService {
  entreprises: Entreprise[];
  entrep: Entreprise = new Entreprise();
  baseurl = 'http://localhost/crudappEntrepriseLog/api/liste';


  constructor(private http: HttpClient) {
  }

  getEntreprise(id: number): Observable<Entreprise> {
    const params = new HttpParams().set('id', id.toString());
    return this.http.get<Entreprise>('http://localhost/crudappEntrepriseLog/api/affUn', {params: params});
  }


  ListEntreprise(): Observable<Entreprise[]> {
    return this.http.get<Entreprise[]>('http://localhost/crudappEntrepriseLog/api/contribuables/all').pipe(
      map((res) => {
        this.entreprises = res;
        console.log('res', res);
        return this.entreprises;
      }));
  }

  UpdateEntreprise(ent: Entreprise): Observable<Entreprise[]> {
    return this.http.put<Entreprise[]>('http://localhost/crudappEntrepriseLog/api/modification', {data: ent});
  }

  DeleteEntreprise(id: string): Observable<Entreprise[]> {
    const params = new HttpParams()
      .set('id', id.toString());
    return this.http.delete<Entreprise[]>('http://localhost/crudappEntrepriseLog/api/suppression', { params : params});

  }

  AjoutEntreprise(ent: Entreprise): Observable<Entreprise[]> {
    return this.http.post<Entreprise[]>('http://localhost/crudappEntrepriseLog/api/enregistrement', {data: ent});
  }
}
